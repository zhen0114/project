<?php
ob_start();
session_start();

require("DBconnect.php");

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

if (isset($_GET['Id'])){
    $Id = $_GET['Id'];
}



if (isset($uId)){
    if (isset($Id) && $Id == 1){
        $finalphoto = 'profile_photo/default.png';
        $ppath_old = 'profile_photo/default.png';
        $sql = "SELECT * FROM forum_account WHERE uId = '$uId'";
        $sql2 = "UPDATE forum_account SET ppath = '$finalphoto' WHERE uId = '$uId'";
        if ($result = mysqli_query($link, $sql)){
            while ($row = mysqli_fetch_assoc($result)){
                $ppath_old = $row['ppath'];
            }
        }
        if ($ppath_old == $finalphoto){
            echo "<script type = 'text/javascript'>";
            echo "alert('您沒有頭貼可刪除！')";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
        }
        else{
            if (mysqli_query($link, $sql2)){
                if (file_exists($ppath_old)){
                    unlink ($ppath_old);
                }
                echo "<script type = 'text/javascript'>";
                echo "alert('刪除成功！')";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
            }
            else{
                echo "<script type='text/javascript'>";
                echo "alert ('刪除失敗！');";
                echo "</script>";
                echo ('Location: member.php');
            }
        }

    }
    else{
        $pathpart = pathinfo($_FILES["photo"]["name"]);
        $extname = $pathpart["extension"];
        
        $default = 'profile_photo/default.png';
        $finalphoto = "profile_photo/".$uId."_".time().".".$extname;
        
        $sql = "SELECT * FROM forum_account WHERE uId = '$uId'";
        $sql2 = "UPDATE forum_account SET ppath = '$finalphoto' WHERE uId = '$uId'";
        
        if ($result = mysqli_query($link, $sql)){
            $row = mysqli_fetch_assoc($result);
            $ppath_old = $row['ppath'];
            if (copy($_FILES["photo"]["tmp_name"], $finalphoto)){
                if (mysqli_query($link, $sql2)){
                    if (($ppath_old != $default) && file_exists($ppath_old)){
                        unlink($ppath_old);
                    }
                    echo "<script type = 'text/javascript'>";
                    echo "alert('更新成功！')";
                    echo "</script>";
                    echo "<meta http-equiv='Refresh' content ='0; url=member.php'>";
                }
                else{
                    echo "<script type='text/javascript'>";
                    echo "alert ('更新失敗！');";
                    echo "</script>";
                    echo ('Location: member.php');
                }
            }
            else{
                echo "<script type='text/javascript'>";
                echo "alert ('更新失敗！');";
                echo "</script>";
                echo ('Location: member.php');
            }
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert ('更新失敗！');";
            echo "</script>";
            echo ('Location: member.php');
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