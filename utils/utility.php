<?php

function getGet($key){
    $value = '';
    if(isset($_GET[$key])){
        $value = $_GET[$key];
        $value = fixSqlInjection($value);
    }
    return trim($value);
}
function getPOST($key){
    $value = '';
    if(isset($_POST[$key])){
        $value = $_POST[$key];
        $value = fixSqlInjection($value);
    }
    return trim($value);
}
function getRequest($key){
    $value = '';
    if(isset($_REQUEST[$key])){
        $value = $_REQUEST[$key];
        $value = fixSqlInjection($value);
    }
    return trim($value);
}
function getCookie($key){
    $value = '';
    if(isset($_COOKIE[$key])){
        $value = $_COOKIE[$key];
        $value = fixSqlInjection($value);
    }
    return trim($value);
}
function fixSqlInjection($sql){
    $sql = str_replace('\\','\\\\',$sql);
    $sql = str_replace('\'','\\\'',$sql);
    return $sql;
}
function getToken(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    }
    $token = getCookie('token');
    $sql = "select * from token where Token = '$token'";
    $item = executeResult($sql,true);
    if($item!=null){
        $userId = $item['Id_user'];
        $sql = " select * from user where Id = '$userId'";
        $item = executeResult($sql,true);
        if($item !=null){
            $_SESSION['user'] = $item;
            return $item;
        }
    }
    return null;
}
function uploadFile($key, $rootPath = "./") {
    if(!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name'] == '') {
        return '';
    }

    $pathTemp = $_FILES[$key]["tmp_name"];

    $filename = $_FILES[$key]['name'];
    //filename -> remove special character, ..., ...

    $newPath="upload/".$filename;

    move_uploaded_file($pathTemp, $rootPath.$newPath);

    return $newPath;
}
function path($thumbnail, $Url = "./") { // thêm đường dẫn folder $Url

    return $Url.$thumbnail;
}
