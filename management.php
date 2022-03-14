<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $user = getToken();
    $rs = $user['Id'];
    $role = $user['Role'];
    $sql = "select * from User where Id ='$rs'"; 
    $data = executeResult($sql);
    $query = "select * from User order by Role ASC"; 
    $dt = executeResult($query);
    $qr = "select count(*) as total from User "; 
    $count = executeResult($qr);
    foreach($count as $value){
        $sl = $value['total'];
    }
    if(strtolower($role)=='admin'){
        require_once('./layoutAdmin/header.php');
    }
    else{
        require_once('./layout/header.php');
    }
?>
<div class="container-fluid">
    <h3 style="text-align:center;">Số lượng thành viên: <?=$sl?></h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>UserName</th>
                <th>Email</th>
                <th>Rold</th>
                <th style="width:10%;"></th>
                <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($dt as $value) {
                    echo'<tr>
                        <td>'.$value['Name'].'</td>
                        <td>'.$value['Email'].'</td>
                        <td>'.$value['Role'].'</td>
                        <td>';
                        if(strtolower($value['Role'])!='admin'){
                            echo '
                                <form method = "post">
                                    <input type="hidden" name="add" value="'.$value['Id'].'"></input>
                                    <button type ="submit" class="btn btn-success" onclick="reload()">Thêm Admin</button>
                                </form>
                            ';
                        }
                        echo'</td>
                        <td>';
                        if(strtolower($value['Role'])=='admin'){
                            echo '
                                <form method = "post">
                                    <input type="hidden" name="del" value="'.$value['Id'].'"></input>
                                    <button type ="submit" class="btn btn-warning" onclick="reload()">Gỡ Admin</button>
                                </form>
                            ';
                        }
                        echo'</td>';
                        
                    echo'</tr>';
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    if(!empty($_POST['add']))
    {
        $id = getPOST('add');
        $sql = "update user set Role = 'admin' where Id = '$id'";
        execute($sql);
    }
    if(!empty($_POST['del']))
    {
        $id2 = getPOST('del');
        $sql2 = "update user set Role = 'user' where Id = '$id2'";
        execute($sql2);
    }
    
?>
