<?php
ob_start();
session_start();

include_once ("DBconnect.php");

if (isset($_SESSION["admin_login"])){
    $uId = $_SESSION["admin_login"];
}
else{
    if (isset($_SESSION["premium_login"])){
        $uId = $_SESSION["premium_login"];
    }
    else{
        if (isset($_SESSION["user_login"])){
            $uId = $_SESSION["user_login"];
        }
    }
}

$Id = $_GET['Id'];

echo "<meta charset='utf-8'>
<title>JKL論壇：更新會員資料</title>";

if (isset($uId)){
    if ($Id == 0){
        $uPwd_old = $_POST['uPwd_old'];
        $uPwd_new = $_POST['uPwd_new'];
        $uPwd_new_confirm = $_POST['uPwd_new_confirm'];
        if ($uPwd_new == $uPwd_new_confirm){
            $sql = "SELECT * FROM forum_account WHERE uId = '$uId'";
            if ($result = mysqli_query ($link, $sql)){
                while ($row = mysqli_fetch_assoc($result)){
                    if ($row['uPwd'] == $uPwd_old){
                        $sql2 = "UPDATE forum_account SET uPwd = '$uPwd_new' WHERE uId = '$uId'";
                        if (mysqli_query ($link, $sql2)){
                            echo "<script type = 'text/javascript'>";
                            echo "alert('密碼更新成功！')";
                            echo "</script>";
                            echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
                        }
                        else{
                            echo "<script type = 'text/javascript'>";
                            echo "alert('資料庫錯誤！請稍後再重試！')";
                            echo "</script>";
                            echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
                        }
                    }
                    else{
                        echo "<script type = 'text/javascript'>";
                        echo "alert('您輸入的舊密碼有誤！請再次確認！')";
                        echo "</script>";
                        echo "<meta http-equiv='Refresh' content ='0; url=update.php?Id=0'>";
                    }
                }
            }
            else{
                echo "<script type = 'text/javascript'>";
                echo "alert('資料庫錯誤！請稍後再重試！')";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
            }
        }
        else{
            echo "<script type = 'text/javascript'>";
            echo "alert('您輸入的新密碼有誤！請再次確認！')";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content ='0; url=update.php?Id=0'>";
        }

    }
    else{
        if ($Id == 1){
            $uName_new = $_POST['uName_new'];
            $sql = "UPDATE forum_account SET uName = '$uName_new' WHERE uId = '$uId'";
            if (mysqli_query($link, $sql)){
                echo "<script type = 'text/javascript'>";
                echo "alert('暱稱修改成功！')";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
            }
            else{
                echo "<script type = 'text/javascript'>";
                echo "alert('資料庫錯誤！請稍後再重試！')";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
            }
        }
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