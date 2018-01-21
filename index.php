<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BUAA Library</title>
</head>
<body>

<form method="post" action="booksearch.php">
    <select name="searchType">
        <option value="bookName">书名</option>
        <option value="bookAuthor">作者</option>
        <option value="bookTypeID">类别</option>
    </select>
    <input type="text" name="keyword">
    <input type="submit" value="搜索">
</form>

<br />
<br />
<br />

<form method="post" action="login.php">
	用户名：<input type="text" name="username" />       <br />
    密 码：<input type="password" name="password" />    <br />
    <input type="submit" name="submit" value="登陆" />
        
    <a href="register.php">注册</a>
</form>
</body>
</html>