<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $user = getToken();
    $rs = $user['Id'];
    $role = $user['Role'];
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
    <?php
    foreach($data as $value)
    {
        echo'
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UserName</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>'.$value['Name'].'</td>
                    <td>'.$value['Password'].'</td>
                    <td>'.$value['Email'].'</td>
                    <td>'.$value['Role'].'</td>
                    
                </tr>
            </tbody>
        </table>';
    }
    ?>
</div> 
    