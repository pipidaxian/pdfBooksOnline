<?php
try {
    $userName = "";
    $password = "";
    $con = new PDO('mysql:host=localhost;dbname=pdfBooksOnline', $userName, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $th) {
    print "Error!: " . $th->getMessage . "<br />";
    die();
}
