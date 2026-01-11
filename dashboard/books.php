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

    <!-- Start Delete Book -->
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $con->prepare("DELETE FROM books WHERE id = '$id'");
        $stmt->execute();
        $deleteSuccess = "<div class = 'alert alert-success'>" . "分类已成功删除 " . "</div>";
    }
    ?>
    <!-- End Delete book -->

    <div class="container-fluid">
        <div class="show-books">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">数字 </th>
                        <th scope="col">书名 </th>
                        <th scope="col">作者</th>
                        <th scope="col">分类 </th>
                        <th scope="col">添加日期 </th>
                        <th scope="col">程序 </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fetch books from database -->
                    <?php
                    $page;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 4;
                    $start = ($page - 1) * $limit;
                    $stmt = $con->prepare("SELECT * FROM books ORDER BY id DESC LIMIT $start,$limit");

                    $stmt->execute();
                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $size = $stmt->rowCount();
                    for ($i = 0; $i < $size; $i++) {
                    ?>

                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $row[$i]['bookTitle']; ?></td>
                            <td><?php echo $row[$i]['bookAuthor']; ?></td>
                            <td><?php echo $row[$i]['bookCat']; ?></td>
                            <td><?php echo $row[$i]['bookDate']; ?></td>
                            <td>
                                <a href="edit-book.php?id=<?php echo $row[$i]['id']; ?>" class="custom-btn">修改 </a>
                                <a href="books.php?id=<?php echo $row[$i]['id']; ?>" class="custom-btn confirm">删除 </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- Start pagination -->
            <?php
            $stmt = $con->prepare("SELECT * FROM books");
            $stmt->execute();
            $total_books = $stmt->rowCount();
            $total_pages = ceil($total_books / $limit);
            ?>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="books.php?page=<?php if (($page - 1) > 0) {
                                                                                        echo  $page - 1;
                                                                                    } else {
                                                                                        echo 1;
                                                                                    }

                                                                                    ?>">上一个 </a></li>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="books.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="books.php?page=<?php
                                                                                    if (($page + 1) < $total_pages) {
                                                                                        echo $page + 1;
                                                                                    } elseif (($page + 1) >= $total_pages) {
                                                                                        echo $total_pages;
                                                                                    }
                                                                                    ?>">下一个 </a></li>
                </ul>
            </nav>
            <!-- End pagination -->

        </div>
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
