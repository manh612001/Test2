<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    $id = getGet('id');
    $user = getToken();
    $role = $user['Role'];
    $rs = $user['Id'];
    $sql1 = "select user.* from user where id ='$rs'";
    $data = executeResult($sql1);
    if(strtolower($role) =="admin")
        require_once('./layoutAdmin/header.php');
    else
        require_once('./layout/header.php');
    $query = "select * from post where Id = '$id'";
    $rs_post = executeResult($query);
?>
<div >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Chỉnh sửa bài viết</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method = "post">
            <?php
                foreach($rs_post as $item){
                    echo'<textarea class="form-control" name ="content" style="min-height:200px;">'.$item['Content'].'</textarea>';
                }
            ?>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Lưu</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
     if(!empty($_POST)){
        $content = getPOST('content');
        if(empty($content)){
            echo"<script>alert('Vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            $sql="update post set Content = '$content' where Id='$id'";
            execute($sql);
            echo"<script>alert('Lưu thành công')</script>"; 
            die(); 
        }
    }
?>
