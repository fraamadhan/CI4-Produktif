<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserDetailModel;

/**
 * @property IncomingRequest $request 
 */


class Auth extends BaseController
{

    public function index()
    {
        $data = [];
        helper(['form']);

        if (session()->get('logged_in')) {
            return redirect()->to('dashboard');
        }
        if ($this->request->getMethod() == 'post') {
            $session = session();
            $model = new UserDetailModel();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $data = $model->where('email', $email)->first();

            $errors = [
                'password' => [
                    'validateUser'  => 'Email or password don\'t match'
                ]
            ];

            $rules = [
                'email' => 'required|min_length[8]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[32]|validateUser[email, password]',
            ];

            if ($data === null) {
                $session->setFlashdata($errors);
                return redirect()->to('/');
            }


            $login = new UserModel();
            $loginData = $login->where('email', $data['email'])->first();
            $pass = $loginData['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'userID'       => $data['userID'],
                    'nama'     => $data['nama'],
                    'alamat'    => $data['alamat'],
                    'email' => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                session()->setFlashdata('msg', 'Login Success!');
                return redirect()->to('dashboard');
            } else {
                $session->setFlashdata($errors);
                return redirect()->to('/');
            }
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                if (isset($_POST['rememberMe'])) {
                    setcookie('login', 'true', time() + 3600);
                    setcookie('email', $_POST['email'], time() + 3600);
                    setcookie('password', $_POST['password'], time() + 3600);
                    setcookie('rememberMe', 'checked', time() + 3600);
                    if (isset($_COOKIE['login'])) {
                        if ($_COOKIE['login'] == 'true') {
                            $_SESSION['login'] = true;
                        }
                    }
                    if (isset($_SESSION['login'])) {
                        $user = $model->where('email', $this->request->getVar('email'))->first();
                        $this->userSetSession($user);
                        return redirect()->to('dashboard');
                    }
                } else {
                    setcookie('email', '');
                    setcookie('password', '');
                    setcookie('rememberMe', '');
                    setcookie('login', '');
                    $user = $model->where('email', $this->request->getVar('email'))->first();
                    $this->userSetSession($user);
                    session()->setFlashdata('msg', 'Login Success!');
                    return redirect()->to('dashboard');
                }
            }
        }
        return view('loginForm', $data);
    }

    private function userSetSession($user)
    {

        $data = [
            'email' => $user['email'],
            'userID' => $user['userID'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email'           => 'required|min_length[8]|max_length[50]|valid_email',
                'password'        => 'required|min_length[8]|max_length[32]',
                'passwordConfirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $userModel = new UserDetailModel();

                $dataLoginUser = [
                    'email'     => $this->request->getPost('email'),
                    'password'  => $this->request->getPost('password'),
                ];
                $dataPersonalUser = [
                    'nama'      => $this->request->getPost('nama'),
                    'alamat'    => $this->request->getPost('alamat'),
                    'email'     => $this->request->getPost('email'),
                    'namaIbu'   => $this->request->getPost('namaIbu'),
                ];
                $model->insert($dataLoginUser);
                $userModel->save($dataPersonalUser);
                session()->setFlashdata('msg', 'Register Success!');
                return redirect()->to('/');
            }
        }
        return view('registerForm', $data);
    }

    public function forgotPassword()
    {
        return view('forgotPassword');
    }

    public function resetPassword()
    {
        $data = [];
        helper(['form']);
        $model = new UserDetailModel();
        $email = $this->request->getVar('email');
        $namaIbu = $this->request->getPost('namaIbu');
        $data = $model->where('email', $email)->first();


        $rules = [
            'email' => 'required|min_length[8]|max_length[50]|valid_email',
            'password'        => 'required|min_length[8]|max_length[32]',
            'passwordConfirm' => 'matches[password]',
        ];

        if ($data === null) {
            return redirect()->to('/');
        }

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('forgotPassword', $data);
        } else {
            if ($namaIbu === $data['namaIbu'] && $email === $data['email']) {
                $modelUser = new UserModel();
                $dataLoginUser = [
                    'email'     => $this->request->getPost('email'),
                    'password'  => $this->request->getPost('password'),
                ];

                $modelUser->update($data['email'], $dataLoginUser);
                return redirect()->to('/');
            }
        }
        return view('loginForm');
    }
    public function logout()
    {
        session()->destroy();
        if (isset($_SESSION['login'])) {
            setcookie('login', '', time() - 3600);
        }
        return redirect()->to('/');
    }
}
