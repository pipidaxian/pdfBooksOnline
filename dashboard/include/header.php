<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>控制面板 </title>
  <!-- favicon -->
  <link rel="icon" type="image/png" href="images/book.png">
  <!-- Bootstrap and Bootstrap Rtl -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-rtl.css">
  <!-- Custom css -->
  <link rel="stylesheet" href="css/custom.css">
  <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">控制面板 </div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action bg-light">概览 </a>
        <a href="profile.php" class="list-group-item list-group-item-action bg-light">个人资料 </a>
        <a href="categories.php" class="list-group-item list-group-item-action bg-light">分类 </a>
        <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="collapse" data-target="#menu">الكتب</a>
        <!-- Collapse menu -->
        <ul class="collapse sub-menu" id="menu">
          <a href="new-book.php" class="list-group-item list-group-item-action bg-light">新曲谱 </a>
          <a href="books.php" class="list-group-item list-group-item-action bg-light">所有曲谱 </a>
        </ul>
      </div>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php" target="_blank">导航链接 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Show user Name  -->
                <?php
                $stmt = $con->prepare("SELECT adminName FROM admin");
                $stmt->execute();
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo $user[0]["adminName"];
                ?>
              </a>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="logout.php">退出 </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
