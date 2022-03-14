<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $user = getToken();
    $rs = $user['Id'];
    $role = $user['Role'];
    $name = $user['Name'];
    $pw = $user['Password'];
    $email = $user['Email'];
    $sql = "select * from User where Id ='$rs'"; 
    $data = executeResult($sql);
    if(strtolower($role)=='admin'){
        require_once('./layoutAdmin/header.php');
    }
    else{
        require_once('./layout/header.php');
    }
?>
<div class="container-fluid mt-5">
    <form  method="post">
        <div class="form-group">
            <label for="name">UserName:</label>
            <input type="text" class="form-control" name="name" value="<?=$name?>">
        </div>
        <div class="form-group">
            <label for="pwd">Email:</label>
            <input type="email" class="form-control"  name="email" value="<?=$email?>">
        </div>
        <div class="form-group ">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control"  name="pwd" value="<?=$pw?>">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div> 
<?php

    if(!empty($_POST)){
        $name = getPOST('name');
        $email = getPOST('email');
        $pw= getPOST('pwd');
        if(empty($name)||empty($email)||empty($pw)){
            echo"<script>alert('Vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            $sql="update user set Name = '$name',Email = '$email',Password='$pw' where Id='$rs'";
            execute($sql);
            echo"<script>alert('Lưu thành công')</script>"; 
            die(); 
        }
    }
?>  