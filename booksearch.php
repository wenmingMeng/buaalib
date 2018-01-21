<?php
    $keyword = $_POST['keyword'];
    // echo $keyword;
    // echo empty($keyword);
    // echo $_POST['searchType'];

    session_start();
    include('./conn.php');
    $conn = new conn("SET NAMES UTF8");
    $conn->execute_sql();
    if ($_POST['searchType'] == "bookName") {
        $conn->sql = "SELECT * FROM system_books_kind WHERE bookName LIKE '%".$keyword."%' LIMIT 20";
    } elseif ($_POST['searchType'] == "bookAuthor") {
        $conn->sql = "SELECT * FROM system_books_kind WHERE bookAuthor LIKE '%".$keyword."%' LIMIT 20";
    } elseif ($_POST['searchType'] == "bookTypeID") {
        // TODO
        $conn->sql = "SELECT * FROM system_books_kind WHERE bookTypeID LIKE '%".$keyword."%' LIMIT 20";
    } else {
        # 错误处理
    }    
    $res = $conn->fetch_res();

    // for ($i = 0; $i < sizeof($res); $i++) {
    //     echo $res[$i]['bookSearchID']."<br/>";
    //     echo $res[$i]['bookName']."<br/>";
    //     echo $res[$i]['bookAuthor']."<br/>";
    //     echo $res[$i]['bookIntro']."<br/>";
    // }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BUAA Library Search Result</title>
</head>
<body>
    <!-- TODO: AJAX异步发请求 -->
    <form method="post" action="booksearch.php">
        <select name="searchType">
            <option value="bookName">书名</option>
            <option value="bookAuthor">作者</option>
            <option value="bookTypeID">类别</option>
        </select>
        <input type="text" name="keyword">
        <input type="submit" value="搜索">
    </form>

    <table border="1">
    <tr>
        <th>书籍ID</th>
        <th>书名</th>
        <th>作者</th>
        <th>简介</th>
    </tr>
    <?php
        for ($i = 0; $i < sizeof($res); $i++) {
            echo "<tr>";
            echo "<td>".$res[$i]['bookSearchID']."</td>";
            echo "<td>".$res[$i]['bookName']."</td>";
            echo "<td>".$res[$i]['bookAuthor']."</td>";
            echo "<td>".$res[$i]['bookIntro']."</td>";
            echo "</tr>";
        } 
    ?>
</table>
</body>
</html>