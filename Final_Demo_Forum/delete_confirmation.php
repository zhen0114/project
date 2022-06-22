<?php
ob_start();
session_start();

include_once ("DBconnect.php");

$uId = $_GET['uId'];
$sql = "DELETE FROM forum_account WHERE uId = '$uId'";

if (isset($_SESSION["admin_login"]) || isset($_SESSION["premium_login"]) || isset($_SESSION["user_login"])){
    if (mysqli_query($link, $sql)){
        echo "<script type = 'text/javascript'>";
        echo "alert('刪除成功')";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content ='0; url=logout.php'>";
    }
    else{
        echo "<script type = 'text/javascript'>";
        echo "alert('刪除失敗')";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
    }
}
else{
    echo "<script type = 'text/javascript'>";
    echo "alert('您尚未登入！請在登入後重試')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
}


ob_flush();
?>