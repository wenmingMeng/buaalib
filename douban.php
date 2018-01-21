<?php
    // 创建一个新cURL资源
    $ch = curl_init();

    $bookID = 1220562;

    // 设置URL和相应的选项
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.douban.com/v2/book/".$bookID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        ]);

    // 抓取URL并把它传递给浏览器
    $res = curl_exec($ch);

    // 关闭cURL资源，并且释放系统资源
    curl_close($ch);

    // 
    var_dump($res);
?>