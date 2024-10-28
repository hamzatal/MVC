<?php 

require_once 'Model.php';

class User extends Model{

    

    public function __construct(){
        parent::__construct('user');
    }
}

?>