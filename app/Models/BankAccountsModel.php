<?php

namespace app\Models;

use CodeIgniter\Model;

class BankAccountsModel extends Model
{

    protected $table      = 'bankaccounts';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'bankName', 'bankLogo', 'city', 'country', 'branchName', 'branchCode', 'currency', 'accountOwner', 'accountNumber', 'ibanNumber'];

    public function getBankAccount($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addBankAccount($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateBankAccount($id = [], $data = []){

        if (empty($data) || empty($id)) {
            return false;
        }

        // return error if couldn't find data for update
        foreach($id as $item){
            
            $bankAccount = $this->find($item);
            if (empty($bankAccount)) {
                return false;
            }
            
        }

        return $this->update($id, $data);
    }

    public function deleteBankAccount($data = []){
        return empty($data) ? false : $this->delete($data);
    }

}
