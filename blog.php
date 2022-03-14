<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $user = getToken();
    $role = $user['Role'];
    $rs = $user['Id'];
    $sql = "select * from blog order by id DESC";
    $dt = executeResult($sql);
    $sql1 = "select user.* from user where id ='$rs'";
    $data = executeResult($sql1);
    
      if(strtolower($role) =="admin")
        require_once('./layoutAdmin/header.php');
      else
        require_once('./layout/header.php');
    
?>
<div class="container">
    <?php
        if(strtolower($role)=='admin')
        {
            echo'<div class="mt-3"><a href="addblog.php"><button class="btn btn-success">Thêm Blog</button></a></div>';
        }
    ?>
    <div class="row mt-3">
    <?php
        foreach($dt as $value){
            echo'
            
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card ">
                        <img src="'.path($value['Img']).'" style=" height:220px;width:100%;"></img>
                        <h4>'.$value['Title'].'</h4>
                        <p>Ngày đăng bài : '.$value['Created_at'].'</p>
                        <div>
                            <a href="detail.php?id='.$value['Id'].'"><button class="btn btn-outline-primary w-100 mb-1">Xem thêm</button></a>';
                        if(strtolower($role)=='admin'){
                            echo '
                            <button class="btn btn-danger w-100" onclick="DelBlog('.$value['Id'].')">Xoá</button>';
                        }  
                        echo'</div>
                    </div>
                </div>
            
            ';
            
        }
    ?>
    </div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function DelBlog(id){
        $.post('api.php',{
            'id': id,
            'action':'delblog'
        },function(data){
            location.reload();
    })
    }
</script>
