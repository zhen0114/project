<?php
require ("DBconnect.php");

$uId = $_POST["uId"];
$uPwd = $_POST["uPwd"];
$uName = $_POST["uName"];
$uRole = $_POST["uRole"];
$uMail = $_POST["uMail"];
$uGender = $_POST["uGender"];
$ppath = "profile_photo/default.png";
if (isset($_POST["invitCode"])){
    $invitCode = $_POST["invitCode"];
    $sql = "SELECT * FROM forum_invitation_code WHERE reg_email = '$uMail' AND code = '$invitCode'";
    if ($result = mysqli_query($link, $sql)){
        if (mysqli_num_rows($result) >= 1){
            $sql2 = "SELECT * FROM forum_account WHERE uMail = '$uMail'";
            if ($result2 = mysqli_query($link, $sql2)){
                if (mysqli_num_rows($result2) >= 1){
                    echo "<script type = 'text/javascript'>";
                    echo "alert('此信箱已註冊！請重新輸入！')";
                    echo "</script>";
                    echo "<meta http-equiv='Refresh' content ='0; url=register.php'>";
                }
                else{
                    $sql3 = "INSERT INTO forum_account (uId, uPwd, uName, uRole, uMail, uGender, ppath) 
                    VALUES ('$uId', '$uPwd', '$uName', '$uRole', '$uMail', '$uGender', '$ppath')";
                    if (mysqli_query($link, $sql3)){
                        echo "<script type = 'text/javascript'>";
                        echo "alert('高級會員註冊成功')";
                        echo "</script>";
                        echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
                    }
                }
            }
        }
        else{
            echo "<script type = 'text/javascript'>";
            echo "alert('邀請碼無效或錯誤！')";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content ='0; url=register.php?reg=1'>";
        }
    }
}
else{
    $sql = "SELECT * FROM forum_account WHERE uMail = '$uMail'";
    if ($result2 = mysqli_query($link, $sql)){
        if (mysqli_num_rows($result2) >= 1){
            echo "<script type = 'text/javascript'>";
            echo "alert('此信箱已註冊！請重新輸入！')";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content ='0; url=register.php'>";
        }
        else{
            $sql2 = "INSERT INTO forum_account (uId, uPwd, uName, uRole, uMail, uGender, ppath) 
            VALUES ('$uId', '$uPwd', '$uName', '$uRole', '$uMail', '$uGender', '$ppath')";
            if (mysqli_query($link, $sql2)){
                echo "<script type = 'text/javascript'>";
                echo "alert('普通會員註冊成功')";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
            }
        }
    }
}