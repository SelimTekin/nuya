<?php

namespace app\Models;

use CodeIgniter\Model;

class AgreementAndTextModel extends Model
{

    protected $table      = 'agreementandtext';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'aboutText', 'userAgreementText', 'termsOfUseText', 'confidentialityAgreementText', 'distanceSellingAgreement', 'deliveryText', 'cancellationRefundExchangeText'];

    public function getAgreementAndText($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addAgreementAndText($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateAgreementAndText($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $agreementAndText = $this->find($id);
        if (empty($agreementAndText)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteAgreementAndText($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
