<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
    header('Location:index.php');
} else {

?>


    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookTitle = $_POST['bookTitle'];
        $bookAuthor = $_POST['authorName'];
        $bookCat = $_POST['bookCat'];
        $bookContent = $_POST['bookContent'];
        // Book Cover
        $imageName = $_FILES['bookCover']['name'];
        $imageTmp = $_FILES['bookCover']['tmp_name'];

        // Book file
        $bookName = $_FILES['book']['name'];
        $bookTmp = $_FILES['book']['tmp_name'];

        if (empty($bookTitle) || empty($bookAuthor) || empty($bookCat) || empty($bookContent)) {
            $error = "<div class='alert alert-danger'>" . "请填写以下字段 " . "</div>";
        } elseif (empty($imageName)) {
            $error = "<div class='alert alert-danger'>" . "请选一张合适的图片 " . "</div>";
        } elseif (empty($bookName)) {
            $error = "<div class='alert alert-danger'>" . "请选择曲谱文件 " . "</div>";
        } else {
            // Book cover
            $bookCover = rand(0, 1000) . "_" . $imageName;
            move_uploaded_file($imageTmp, "../uploads/bookCovers/" . $bookCover);
            // Book 
            $book = rand(0, 1000) . "_" . $bookName;
            move_uploaded_file($bookTmp, "../uploads/books/" . $book);
            $query          = "UPDATE books SET 
            bookTitle      = '$bookTitle',
            bookAuthor  = '$bookAuthor',
            bookCat        = '$bookCat',
            bookCover    = $bookCover',
            book             = '$book',
            bookContent = '$bookContent'
            WHERE id      ='$id'
            ";
            $stmt = $con->prepare($query);
            $res = $stmt->execute();
            if (isset($res)) {
                $success = "<div class='alert alert-success'>" . "曲谱已成功添加 " . "</div>";
            }
        }
    }
    ?>

    <div class="container-fluid">
        <!-- Start new book -->
        <div class="new-book">
            <?php
            if (isset($error)) {
                echo $error;
            } elseif (isset($success)) {
                echo $success;
            }

            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">书名 </label>
                    <input type="text" id="title" class="form-control" name="bookTitle" value="<?php if (isset($bookTitle)) {
                                                                                                    echo $bookTitle;
                                                                                                } ?>">
                </div>
                <div class="form-group">
                    <label for="author">作者 </label>
                    <input type="text" id="author" class="form-control" name="authorName" value="<?php if (isset($bookAuthor)) {
                                                                                                        echo $bookAuthor;
                                                                                                    } ?>">
                </div>
                <div class="form-group">
                    <label for="title">分类 </label>
                    <select class="form-control" name="bookCat">
                        <option></option>
                        <?php
                        $stmt = $con->prepare("SELECT categoryName FROM categories");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <option><?php echo $row['categoryName']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">封面 </label>
                    <input type="file" class="form-control" name="bookCover">
                </div>
                <div class="form-group">
                    <label for="img">曲谱 </label>
                    <input type="file" class="form-control" name="book">
                </div>
                <div class="form-group">
                    <label for="img">关于 </label>
                    <textarea name="bookContent" id="" cols="30" rows="10" class="form-control"><?php if (isset($bookContent)) {
                                                                                                    echo $bookContent;
                                                                                                } ?></textarea>
                </div>
                <button class="custom-btn">出版 </button>
            </form>
        </div>
        <!-- End new book -->
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include 'include/footer.php';
    ?>


<?php
}
?>
