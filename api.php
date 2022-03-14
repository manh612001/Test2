<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $user = getToken();
    if($user== null){
        die();
    }
    if(!empty($_POST)){
        $action = getPOST('action');
        switch($action){
            case 'update':
                update();
                break;
            case 'delete':
                Delete();
                break;
            case 'delblog':
                DelBlog();
                break;
        }
    }
    function DelBlog(){
        $id = getPOST('id');
        $sql="delete from blog where Id = $id";
        execute($sql);
    }
    function Delete(){
        $id = getPOST('id');
        $sql="delete from post where Id = $id";
        execute($sql);
    }
    function update() {
        $id = getPost('id');
        $sql = "update post set Status = 1 where Id = $id";
        execute($sql);
    }
?>