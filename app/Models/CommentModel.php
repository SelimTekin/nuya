<?php

namespace app\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{

    protected $table      = 'comments';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'productId', 'userId', 'score', 'commentText', 'commentDate', 'commentIpAddress'];

    public function getComment($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addComment($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateComment($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $comment = $this->find($id);
        if (empty($comment)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteComment($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
