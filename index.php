<?php
  session_start();
  require_once('./utils/utility.php');
  require_once('./database/dbhelper.php');
  $user = getToken();
  if($user==null)
  {
    header('Location:./login.php');
    die();
  }
  $rs = $user['Id'];
  $role = $user['Role'];
  $sql = "select user.* from user where id ='$rs'";
  $data = executeResult($sql);
  foreach($data as $value)
  {
    $name = $value['Name'];
  }
?>
    <!-- header-->
    <?php 
      if(strtolower($role) =="admin")
        require_once('./layoutAdmin/header.php');
      else
        require_once('./layout/header.php');
    ?>
    <!--End Header-->
    <!-- Main-->
    <?php
      if(strtolower($role) =="admin")
        require_once('./layoutAdmin/index.php');
      else
        require_once('./layout/index.php');
    ?>
    <!--End Main-->
    <!-- footer-->
    <?php require_once('./layout/footer.php')?>
    <!--End Footer-->
  </body>
</html>
