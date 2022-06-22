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
        $row = mysqli_fetch_assoc($result);
        $uNo = $row["uNo"];

    }

    $followed = $_GET["followed"];
    $tNo = $_GET["tNo"];

    if($followed == 0){
        $SQL="INSERT INTO follow(uNo,fNo) VALUE ('$uNo','$tNo')";
        if(mysqli_query($link,$SQL)){
            echo "<script type = 'text/javascript'>";
            echo "alert('追蹤成功');";
            echo "</script>";
            echo "<meta http-equiv = 'Refresh' content = '0; url = catalog.php?tNo=".$tNo."'>";
            
            $SQL_new_follow_count = "SELECT COUNT(*) AS num FROM follow WHERE fNo = '$tNo'";
            if($result = mysqli_query($link,$SQL_new_follow_count)){
                while($row = mysqli_fetch_assoc($result)){
                    $follow_count_new = $row["num"];
                    echo $follow_count_new;
    
                    $SQL_update_follow = "UPDATE type SET numFollow = '$follow_count_new' WHERE tNo = '$tNo'";
                    if(mysqli_query($link,$SQL_update_follow)){
                        echo "追蹤數修改成功";
                    }
                }
            }
        }else{
            echo "<script type = 'text/javascript'>";
            echo "alert('追蹤失敗');";
            echo "</script>";
            echo "<meta http-equiv = 'Refresh' content = '0; url = index.php?tNo=".$tNo."'>";
        }
    }else{
        $SQL="DELETE FROM follow WHERE uNo = '$uNo' AND fNo = '$tNo'";
        if(mysqli_query($link,$SQL)){
            echo "<script type = 'text/javascript'>";
            echo "alert('取消追蹤成功');";
            echo "</script>";
            echo "<meta http-equiv = 'Refresh' content = '0; url = catalog.php?tNo=".$tNo."'>";
            
            $SQL_new_follow_count = "SELECT COUNT(*) AS num FROM follow WHERE fNo = '$tNo'";
            if($result = mysqli_query($link,$SQL_new_follow_count)){
                while($row = mysqli_fetch_assoc($result)){
                    $follow_count_new = $row["num"];
                    echo $follow_count_new;
    
                    $SQL_update_follow = "UPDATE type SET numFollow = '$follow_count_new' WHERE tNo = '$tNo'";
                    if(mysqli_query($link,$SQL_update_follow)){
                        echo "追蹤數修改成功";
                    }
                }
            }
        }else{
            echo "<script type = 'text/javascript'>";
            echo "alert('取消追蹤失敗');";
            echo "</script>";
            echo "<meta http-equiv = 'Refresh' content = '0; url = index.php?tNo=".$tNo."'>";
        }
    }

    
?>