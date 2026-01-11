<?php 
    session_start();
    include 'include/connection.php';
    // check if session isset
    if(isset($_SESSION['adminInfo'])){
        header('Location:dashboard.php');
    }
    else{
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录 </title>
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/dashboard.css">

<style>
  .login{
    width: 300px;
    margin: 80px auto;
    font-family: janna lt;
  }
  .login h5{
    color: #555;
    margin-bottom: 30px;
    margin-top: 10px;
    text-align: center;
  }
  .login button{
    margin-right: 80px;
    padding: 5px;
    width: 140px;
    background: #00b593;
    border: 1px solid #00b593;
    color: #fff;
  }
</style>

</head>

<body>

  <div class="login">
<!-- Log to dashboard  -->
   <?php 
    if(isset($_POST['log'])) {
      $adminInfo = $_POST['adminInfo'];
      $adminPass = $_POST['password'];

      if(empty($adminInfo) || empty($adminPass))
        {
          echo "<div class = 'alert alert-danger'>"."请填写以下字段 "."</div>";
        }
        else{
          $stmt = $con->prepare("SELECT * FROM admin WHERE (adminName = '$adminInfo' OR adminEmail = '$adminInfo') AND adminPass = '$adminPass'");
          $stmt->execute();
          if($stmt->rowCount() > 0) {
            $_SESSION['adminInfo'] = $adminInfo;
            header('Location:dashboard.php');
          }
           else{
            echo "<div class = 'alert alert-danger'>"."数据不匹配，请再试一次 "."</div>";
           } 
        
        }



    }
   
   
   
   ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <h5>登录 </h5>
      <div class="form-group">
        <label for="mail">用户名或电子邮件 </label>
        <input type="text" class="form-control"  id="mail" name="adminInfo"/>
      </div>
      <div class="form-group">
        <label for="pass">كلمة السر</label>
        <input type="password" class="form-control"  id="pass" name="password"/>
      </div>
      <button class="custom-btn" name="log">登录 </button>
    </form>
  </div>

  <?php
    include 'include/footer.php';
  ?>


<?php
    }
?>
