
<?php
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $fullname =$email =$mess='';
    if(!empty($_POST)){
        $name = getPOST('name');
        $email = getPOST('email');
        $pw = getPOST('password');
        $role = getPOST('role');

        if(empty($name)||empty($email)||empty($pw)||empty($role)){
            echo"<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
        }
        else{
            $userExist = executeResult("select * from user where email = '$email'",true);
            if($userExist!=null){
                echo"<script>alert('Email đã tồn tại')</script>";
            }
            else{
                $sql = "insert into user(Name,Email,Password,Role) values ('$name','$email','$pw','$role')";
                execute($sql);
                echo"<script>alert('Đăng ký thành công')</script>";
                
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/login.css">
    <title>Đăng ký tài khoản</title>
</head>
<body>
    <form class="form-login" method="post" style="height:450px">
        <h2 style="margin-bottom:10px;">Đăng ký tài khoản!</h2> 
        <div class="txtb">
            <input type="text" placeholder="Name" name="name" require="true">
        </div>
        <div class="txtb">
            <input type="email" placeholder="Email" name="email" require="true">
        </div>
        <div class="txtb">
            <input type="password" placeholder="Password" name="password" require>
        </div>
        <div>
            <input type="hidden"  name="role" value="user">
        </div>
        <input type="submit" class="logbtn" value="Đăng ký" >
        <div style="text-align:center; margin-top:20px;"><a href="login.php">Quay lại</a></div>
     </form>
</body>
</html>