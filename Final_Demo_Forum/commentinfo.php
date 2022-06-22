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
            }
        }
    }

    
    $SQL_user = "SELECT * FROM forum_account WHERE uId = '$uId'";
    if($result = mysqli_query($link,$SQL_user)){
        while($row = mysqli_fetch_assoc($result)){
            $uNo = $row["uNo"];
        }
    }

    $pNo = $_GET["postNum"];
    $comment = $_POST["uComment"];

    date_default_timezone_set('Asia/Taipei');
    $time = date("Y-d-m H:i:s", time());

    $SQL="INSERT INTO comment(cNo,uNo,message,cDate) VALUE ('$pNo','$uNo','$comment','$time')";

    if(mysqli_query($link,$SQL)){
        echo "<script type = 'text/javascript'>";
        echo "alert('留言成功');";
        echo "</script>";
        echo "<meta http-equiv = 'Refresh' content = '0; url = text.php?pNo=".$pNo."'>";

        $SQL_new_comment_count="SELECT COUNT(*) AS num FROM comment WHERE cNo = '$pNo'";

        if($result = mysqli_query($link,$SQL_new_comment_count)){
            while($row = mysqli_fetch_assoc($result)){
                $comment_count_new = $row["num"];
                echo $comment_count_new;
    
                $SQL_update_comment = "UPDATE post SET sumComment = '$comment_count_new' WHERE pNo = '$pNo'";
                if(mysqli_query($link,$SQL_update_comment)){
                    echo "追蹤數修改成功";
                }
            }
        }
    }else{
        echo "<script type = 'text/javascript'>";
        echo "alert('留言失敗');";
        echo "</script>";
        echo "<meta http-equiv = 'Refresh' content = '0; url = text.php?pNo=".$pNo."'>";
    }
?>