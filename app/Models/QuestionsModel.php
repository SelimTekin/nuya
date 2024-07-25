<?php

namespace app\Models;

use CodeIgniter\Model;

class QuestionsModel extends Model
{

    protected $table      = 'questions';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'question', 'answer'];

    public function getQuestion($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addQuestion($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateQuestion($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $question = $this->find($id);
        if (empty($question)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteQuestion($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
