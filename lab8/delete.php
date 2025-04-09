<?php
include "connect.php";

if (isset($_GET["stcode"])) {
    $stcode = $_GET["stcode"];
    $query = "DELETE FROM students WHERE stcode=$stcode";

    if (mysqli_query($con, $query)) {
        header("Location: index.php");
    } else {
        echo "Устгах явцад алдаа гарлаа: " . mysqli_error($con);
    }
}
?>
