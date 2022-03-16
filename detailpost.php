<?php
    session_start();
    require_once('./utils/utility.php');
    require_once('./database/dbhelper.php');
    
    $id = getGet('id');
    
    $user = getToken();
    $rs = $user['Id'];
    $role = $user['Role'];
    $sql1 = "select user.* from user where id ='$rs'";
    $data = executeResult($sql1);
    $qr = "select User.*,post.* from post inner join user on post.User_id = User.Id where Post.Status = 1  and Post.Id = '$id'";
    $post = executeResult($qr);
    if(strtolower($role) =="admin")
        require_once('./layoutAdmin/header.php');
    else
        require_once('./layout/header.php');

    foreach($post as $value){
            echo'
              <div class="mb-2" >
                  <div class="media border p-3" >
                  <img src="./upload/images.png" class="mr-3 mt-1 rounded-circle" style="width:60px; height:60px;">
                      <div class="media-body">';
                          if($value['User_id']==$rs)
                          {
                            echo '
                                <div class="dropdown  float-right">
                                    <button type="button" class="btn dropdown-toggle " data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href ="editpost.php?id='.$value['Id'].'"><button  class="dropdown-item  ">chỉnh sửa</button></a>
                                    </div>
                                </div>';
                          }
                              $s = "select * from post where Id = ".$value['Id']."";
                              $d = executeResult($s);
                      echo'    
                          <h4>'.$value['Name'].'</h4>
                          <h6><small><i>Ngày đăng: '.$value['Created_at'].'</i></small></h6>
                          <p style="font-size:30px;">'.$value['Content'].'</p>
                          <div class="cmt">
                          <form  method="post" class="mb-2">
                              <div class="input-group">
                                  <input type="text"  name = "cmt" class="form-control" placeholder="Viết bình luận vào đây...">
                                  <input type="hidden" name ="id-post" value = "'.$value['Id'].'">
                                  <input type="hidden" name ="id-user" value = "'.$rs.'">
                                  <div class="input-group-prepend">
                                      <a href ="index.php" ><button type ="submit" onclick="reload()" class="btn btn-info ml-1">Đăng</button></a>
                                  </div>
                              </div>
                          </form>';
                          $cmt ="select user.Name as name,comments.Content as content from comments inner join post on comments.Id_post = post.Id inner join user on comments.Id_user = user.Id where comments.Id_post = ".$value['Id']."";
                          $rscmt = executeResult($cmt);
                          foreach($rscmt as $item){
                              echo '
                              <div class=" media border p-2 mb-2" style="border-radius:10px;">
                                  <img src="./upload/images.png"  class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                  <div class="media-body">
                                      <span style="font-size:24px;">'.$item['name'].'</span>
                                      <p>'.$item['content'].'</p>
                                  </div>
                            </div>' ;
                          }
                      echo'
                      </div>
                  </div>
                  </div>
              </div>';
          }
    if(!empty($_POST['cmt'])){
        $content = getPOST('cmt');
        $id_post = getPOST('id-post');
        $id_user = getPOST('id-user');
        if(empty($content)){
            echo"<script>alert('Vui lòng điền đầy đủ thông tin')</script>";
        }
        else{
            $sql="insert into comments (Id_post,Id_user,Content) values('$id_post','$id_user','$content')";
            execute($sql); 
            die(); 
        }
    }
?>
