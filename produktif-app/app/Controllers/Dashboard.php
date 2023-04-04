<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserDetailModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(){
        $model = new UserDetailModel();
        $data = [
            'profile'  => $model->getAccount(session()->get('userID')),
        ];
        return view('dashboard', $data);
    }

    public function update($id){
        $model = new UserDetailModel();

        $data = [
            "nama"       => $this->request->getPost('nama'),
            "alamat"       => $this->request->getPost('alamat'),
        ];

        $model->updateAccount($id, $data);
        return redirect()->to('dashboard');
    }

    public function delete($email, $userID){
        $modelUser = new UserModel();
        $modelUserDetail = new UserDetailModel();
        $modelUserDetail->deleteAccount($userID);
        $modelUser->deleteAccount($email);
        $ses_data = [
            'userID'       =>  null,
            'nama'     =>  null,
            'alamat'    =>  null,
            'email' =>  null,
            'logged_in'     => FALSE
        ];
        session()->set($ses_data);
        return redirect()->to('/');
    }
}