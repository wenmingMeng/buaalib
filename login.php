<?php
    // 判断是否有submit操作
    if(!isset($_POST['submit'])){  
        exit('非法访问!');  
    }
    
    // 获取表单信息
    $username = addslashes($_POST['username']);
    $password = addslashes(md5($_POST['password']));

    include('./conn.php');
    $conn = new conn("SET NAMES UTF8");
    $conn->execute_sql();
    $conn->sql = "SELECT userPassword, userType FROM system_users WHERE userID='".$username."'";
    $res = $conn->fetch_res();

    if(empty($res[0]['userPassword'])) {                // 用户名不存在
        // header("Location:index.php");
        echo "用户名不存在";        
    } else if($res[0]['userPassword'] != $password) {   // 密码错误
        // header("Location:index.php");
        echo "密码错误";        
    } else if($res[0]['userPassword'] == $password) {   // 登陆成功
        // 区别不同用户类型
        if($res[0]['userType'] == 1) {
            echo "普通用户";
        } elseif ($res[0]['userType'] == 2) {
            echo "管理员";
        } elseif ($res[0]['userType'] == 3) {
            echo "超级管理员";
        }

        // 记录 session 信息
        session_start();                                // 会话记录
        $_SESSION['userID'] = $username;                // 用户ID
        $_SESSION['userType'] = $res[0]['userType'];    // 用户类型
    }
?>