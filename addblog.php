<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    
    $user = getToken();
    $role = $user['Role'];
    $rs = $user['Id'];
    $sql1 = "select user.* from user where id ='$rs'";
    $data = executeResult($sql1);
    require_once('./layoutAdmin/header.php');
?>
<div class="container-fluid">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" class="form-control"  id="title" name="title">
        </div>
        <div class="form-group">
            <label>Hình ảnh</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail"accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" >
        </div>
        <div class="form-group">
            <label>Nội dung</label>
            <textarea class="form-control" name="content" id="content" value="" cols="30" rows="10"></textarea>
        </div> 
        <button  type="submit" class="btn btn-success ">Thêm</button> 
    </form>
</div>
<?php
    if(!empty($_POST)){
        $title = getPOST('title');
        $thumbnail = uploadFile('thumbnail');
        $content = getPOST('content');
        $creat_at = date('Y-m-d');
        if(!empty($title)&&!empty($thumbnail)&&!empty($content)&&!empty($creat_at)){
            $sql = "insert into blog(Title,Content,Img,Created_at) values ('$title','$content','$thumbnail','$creat_at')";
            execute($sql);
            echo"<script>alert('Thêm thành công')</script>";
            die();
        }
        else{
            echo"<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
        }
    }
?>
