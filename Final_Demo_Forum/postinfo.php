<?php
    require("DBconnect.php");
    session_start();

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
            }else{
                $uId = "null"; 
            }
        }
    }

    $SQL_user = "SELECT * FROM forum_account WHERE uId = '$uId'";
    if($result = mysqli_query($link,$SQL_user)){
        while($row = mysqli_fetch_assoc($result)){
            $uNo = $row["uNo"];
        }
    }

    $tNo = $_GET["tNo"];
    $title = $_POST["Title"];
    $content = $_POST["Content"];
    if($_POST["photo"] == ""){
        $pic = "null";
    }else{
        $pic = $_POST["photo"];
    }

    date_default_timezone_set('Asia/Taipei');
    $time = date("Y-d-m H:i:s", time());

    $SQL="INSERT INTO post(uNo,tNo,title,content,pic,pDate) VALUE ('$uNo','$tNo','$title','$content','$pic','$time')";

    if(mysqli_query($link,$SQL)){
        $SQL_post="SELECT * FROM post WHERE uNo = '$uNo' AND pDate = '$time'";

        if($result = mysqli_query($link,$SQL_post)){
            while($row = mysqli_fetch_assoc($result)){
                $pNo = $row["pNo"];
            }
        }

        echo "<script type = 'text/javascript'>";
        echo "alert('發文成功');";
        echo "</script>";
        echo "<meta http-equiv = 'Refresh' content = '0; url = text.php?pNo=".$pNo."'>";

        $SQL_numpost="SELECT COUNT(*) AS follow_count_new FROM post WHERE tNo = '$tNo'";
        if($result9 = mysqli_query($link,$SQL_numpost)){
            $row9 = mysqli_fetch_assoc($result9);
            $follow_count_new = $row9["follow_count_new"];
            
        }

        $SQL_update_numpost="UPDATE type SET numPost = '$follow_count_new' WHERE tNo = '$tNo'";
        if($result1 = mysqli_query($link,$SQL_update_numpost)){
        }
    }else{
        echo "<script type = 'text/javascript'>";
        echo "alert('發文失敗');";
        echo "</script>";
        echo "<meta http-equiv = 'Refresh' content = '0; url = post.php'>";
    }
?>