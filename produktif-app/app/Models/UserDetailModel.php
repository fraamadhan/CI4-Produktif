<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class UserDetailModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'userID';
    protected $allowedFields = ['userID', 'nama', 'alamat', 'email', 'namaIbu'];

    public function getAccount($id = false){
        if($id === false){
            return $this->findAll();
        }
        else{
            return $this->where('userID', $id)->first();
        }
    }

    public function saveAccount($data){
        return $this->insert($data);
    }

    public function updateAccount($id, $data){
        return $this->update($id, $data);
    }

    public function deleteAccount($userID){
        return $this->delete($userID);
    }
}