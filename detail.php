<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    
    $id = getGet('id');
    $sql = "select * from blog where id = $id";
    $dt = executeResult($sql);
    $user = getToken();
    $rs = $user['Id'];
    $role = $user['Role'];
    $sql1 = "select user.* from user where id ='$rs'";
    $data = executeResult($sql1);
    if(strtolower($role) =="admin")
        require_once('./layoutAdmin/header.php');
    else
        require_once('./layout/header.php');
?>
<div class="container">
    <?php
        foreach($dt as $value){
            echo '
                
                <div class="card">
                    <img src="'.path($value['Img']).'" style=" width:50%; margin:10px auto;"></img>
                    <div class="card-body">
                        <h4 style="text-align:center;" class="card-title">'.$value['Title'].'</h4>
                        <p>Ngày đăng bài : '.$value['Created_at'].'</p>
                        <p>'.$value['Content'].'</p>
                    </div>
                </div>
                
            ';
        }
    ?>
</div>