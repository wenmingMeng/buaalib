<?php
class addBook
{
	function getBookInfoWithISBN($ISBN)
	{
		$ch = curl_init();
		
        //$bookID = 1220562;
    
        // 设置URL和相应的选项
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.douban.com/v2/book/isbn/:'.$ISBN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            ]);
    
        // 抓取URL并把它传递给浏览器
        $res = curl_exec($ch);
        // 关闭cURL资源，并且释放系统资源
        curl_close($ch);
        $res=json_decode($res,true);

        //var_dump($res);

        $resArray['bookISBN']=$res['isbn13'];
        $resArray['bookName']=$res['title'];
        $resArray['bookAuthor']=$res['author'][0];
        for($i=1;$i<sizeof($res['author']);$i++)
        {
            $resArray['bookAuthor']=$resArray['bookAuthor'].','.$res['author'][$i];
        }
        $resArray['bookIntro']=$res['summary'];
        $resArray['authorIntro']=$res['author_intro'];

        $resArray['bookType']=$res['tags'][0]['name'];
        for($i=1;$i<sizeof($res['tags']);$i++)
        {
            $resArray['bookType']=$resArray['bookType'].','.$res['tags'][$i]['name'];
        }
        $resArray['bookImage']=$res['images']['large'];
        $resArray['bookContent']=$res['catalog'];
        $resArray['bookPublisher']=$res['publisher'];
        $resArray['bookPubDate']=$res['pubdate'];
        
        $resArray['bookInDate']=date("Y/m/d");
        
        $resArray['doubanScore']=$res['rating']['average'];
        $resArray['doubanScoreNum']=$res['rating']['numRaters'];
        $resArray['bookPrice']=(double)(strstr($res['price'],'元',true));
        return $resArray;
        
    }

    function insertDatabase($bookInfo)
    {
        include('./conn.php');
        $conn = new conn("SET NAMES UTF8");
        $conn->execute_sql();
        $conn->sql = "insert into system_books_kind (bookISBN,bookName,bookAuthor,bookIntro,authorIntro,bookType,bookImage,bookContent,bookPublisher,bookPubDate,bookInDate,doubanScore,doubanScoreNum,bookPrice,bookborrowOrNot,bookPreserveNum) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $conn->execute_sql_with_params($bookInfo);
    }
}

    $conn = new addBook();
    
    $result = $conn->getBookInfoWithISBN('978-7-111-40701-0');
    //echo ($res);
    $result['bookBorrowOrNot']=1;
    $result['bookPreserveNum']=3;
    var_dump($result);
    $conn->insertDatabase($result);

    




  
?>