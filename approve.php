<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $sql = "select User.*,post.* from post inner join user on post.User_id = User.Id where Post.status = 0";
    $dt = executeResult($sql);
    $user = getToken();
    $rs = $user['Id'];
    $role = $user['Role'];
    $sql1 = "select user.* from user where id ='$rs'";
    $data = executeResult($sql1);
    $s = "select count(*) as total from post where status = 0";
    $d = executeResult($s);
    foreach($d as $value){
        $count = $value['total'];
    }
    require_once('./layoutAdmin/header.php');
    
?>
<div class="container">
    <?php   
        if($count<=0){
            echo'<h2 style="text-align:center;">Không có bài viết nào cần phê duyệt </h2>';
        }
        else{
        foreach($dt as $value){
            echo'
                <div class="mb-2">
                    <div class="media border p-3">
                    <img src="./upload/images.png" class="mr-3 mt-1 rounded-circle" style="width:60px; height:60px;">
                        <div class="media-body">
                            <h4>'.$value['Name'].' <small><i>Ngày đăng '.$value['Created_at'].'</i></small></h4>
                            <p>'.$value['Content'].'</p>
                        </div>
                        <div>
                            <button onclick="Update('.$value['Id'].')"  class="btn btn-primary" >Phê duyệt</button>
                            <button onclick="Delete('.$value['Id'].')" class="btn btn-danger" >Từ chối</button>
                        </div>
                    </div>
                </div>';
        }
    }
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function Delete(id){
        $.post('api.php',{
            'id': id,
            'action':'delete'
        },function(data){
            location.reload();
    })
    }
    function Update(id) {
		$.post('api.php', {
			'id': id,
			'action': 'update'
		}, function(data) {
			location.reload();
		})
	}
</script>
