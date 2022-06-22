<?php
require ("DBconnect.php");

$reg_email = $_POST["reg_email"];
$code = $_POST["code"];
$sql = "INSERT INTO forum_invitation_code (reg_email, code) VALUES ('$reg_email', '$code')";
if (mysqli_query($link, $sql)){
    echo "<script type = 'text/javascript'>";
    $str = "邀請成功！ 邀請碼：".$code;
    echo "alert('".$str."')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
}
else{
    echo "<script type = 'text/javascript'>";
    echo "alert ('邀請失敗！');";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content ='0; url=index.php'>";
}