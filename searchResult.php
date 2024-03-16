<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Search Results</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <?php
            require("./Components/loader.php");  //Loader Component

            echo('<div class="content">');
    
            require("./Components/header.php");  //Header Component

            // <!-- Navigation List -->
            if(isset($_SESSION['userid'])){
                echo("<div class='navList'>
                            <a href='dashboard.php' class='linkAni'>Profile</a>
                            <a href='addBook.php' class='linkAni'>Add Book</a>
                            <a href='#' class='linkAni'>Messages</a>
                            <a href='about.html' class='linkAni'>About Us</a>
                        </div>");
                        $host = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "book_pedlar";
                        $userid=$_SESSION['userid'];
            
                        $conn = mysqli_connect($host, $username, $password, $database);
                        if (!$conn) {
                            die("Connection failed");}
            
                        $type=$_REQUEST["selectValue"];
                        $value=$_REQUEST["searchInput"];
                        $capitalize_value=ucwords($value);
                        $keywords = explode(' ', $capitalize_value);
            
                        if($value==""){
                            $sql="SELECT * FROM book_data where userid!=$userid";
                        }else if($type=="All"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'
                                                     OR author LIKE '%$keyword%'
                                                     OR publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR author='$capitalize_value' OR publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause && userid!=$userid ORDER BY
                            CASE
                                WHEN (bookname='$capitalize_value') THEN 1
                                WHEN (author='$capitalize_value') THEN 2
                                WHEN (publisher='$capitalize_value') THEN 3
                                else 4
                                END";
                        }else if($type=="Book Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause && userid!='$userid' ORDER BY
                        CASE
                            WHEN bookname='$capitalize_value' THEN 1 ELSE 2 END";
                        }else if($type=="Author Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "author LIKE '%$keyword%'";
                            }
                            $whereClause = "(author='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause && userid!='$userid' ORDER BY
                        CASE
                            WHEN author='$capitalize_value' THEN 1 else 2 end";
                        }else if($type=="Publisher"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause && userid!='$userid' ORDER BY
                        CASE
                            WHEN publisher='$capitalize_value' THEN 1 else 2 end";
                        }
            }else{
                echo("<div class='navList'>
                            <a href='index.php' class='linkAni'>Home</a>
                            <a href='loginPage.php' class='linkAni'>Create Profile</a>
                            <a href='loginPage.php' class='linkAni'>Buy/Sell Books</a>
                            <a href='about.html' class='linkAni'>About Us</a>
                        </div>");
                        $host = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "book_pedlar";
                        // $userid=$_SESSION['userid'];
            
                        $conn = mysqli_connect($host, $username, $password, $database);
                        if (!$conn) {
                            die("Connection failed");}
            
                        $type=$_REQUEST["selectValue"];
                        $value=$_REQUEST["searchInput"];
                        $capitalize_value=ucwords($value);
                        $keywords = explode(' ', $capitalize_value);
            
                        if($value==""){
                            $sql="SELECT * FROM book_data";
                        }else if($type=="All"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'
                                                     OR author LIKE '%$keyword%'
                                                     OR publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR author='$capitalize_value' OR publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause ORDER BY
                            CASE
                                WHEN (bookname='$capitalize_value') THEN 1
                                WHEN (author='$capitalize_value') THEN 2
                                WHEN (publisher='$capitalize_value') THEN 3
                                else 4
                                END";
                        }else if($type=="Book Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause ORDER BY
                        CASE
                            WHEN bookname='$capitalize_value' THEN 1 ELSE 2 END";
                        }else if($type=="Author Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "author LIKE '%$keyword%'";
                            }
                            $whereClause = "(author='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClauseORDER BY
                        CASE
                            WHEN author='$capitalize_value' THEN 1 else 2 end";
                        }else if($type=="Publisher"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause ORDER BY
                        CASE
                            WHEN publisher='$capitalize_value' THEN 1 else 2 end";
                        }
            }
            
            $query_result=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($query_result);
            $arr1=array();
            $arr2=array();
            $arr3=array();
            echo("<div class='search-results'>Search Results</div><div class='outside-all-books' style='display: flex;flex-wrap: wrap;padding-left: 10rem;padding-right: 10rem;padding-top: 2rem;'>");
            if($count>0){
              while($row4=mysqli_fetch_array($query_result)){
                $book_name4=$row4['bookname'];
                $author4=$row4['author'];
                $publisher4=$row4['publisher'];
                $actual_price4=$row4['actualprice'];
                $sell_price4=$row4['sellprice'];
                $book_status4=$row4['bookstatus'];
                $genre4=$row4['genre'];
                $book_condition4=$row4['bookcondition'];
                $add_info4=$row4['addinfo'];
                $photo4="uploads/".$row4['photo'];
                $book_id4=$row4['id'];
                $discount4=(int)((($actual_price4-$sell_price4)/$actual_price4)*100);
                array_push($arr1,$book_id4);
                array_push($arr2,$photo4);
                if($book_status4=="Available"){
                    array_push($arr3,false);
                }else{
                    array_push($arr3,true);
                }
                echo("<div class='book-outer' id='book-outer-$book_id4' onmouseover='this.style.cursor=`pointer`'>
                                <div class='book-inner1' id='book-$book_id4'></div>
                                <div class='book-inner2'style='padding: 0.3rem;
                                width: 50%;
                                height: 98%;
                                display: flex;
                                flex-direction: column;
                                border-left: 0.3rem solid black;'>
                                    <div class='heading-book' style='text-align:center;'>
                                        <b>\"$book_name4\"</b>
                                    </div>
                                    <div class='details-book'>
                                        <h5>Author</h5> $author4<br><br>
                                        <h5>Publisher</h5> $publisher4<br><br>
                                        <h5>Genre</h5> $genre4<br>
                                    </div>
                                    <div class='price-book'>
                                        <h2 style='color:green;text-decoration:none;display:inline;'>&#x20b9;$sell_price4</h2><br>
                                        <h6 style='color:red;text-decoration:line-through;display:inline;'>&#x20b9;$actual_price4</h6>
                                        <h4 style='color:green;display:inline;'>$discount4%</h4><h4 style='display:inline;'>off</h4>
                                    </div> 
                                </div>
                            </div>");
              }
            }else{
                echo("No Books match your search. Tap on \"NOTIFY ME\" to get personalized e-mail whenever this book becomes available.");
                // $to_email = "paras140902@gmail.com";
                // $subject = "Simple Email Test via PHP";
                // $body = "Hi, This is test email send by PHP Script";
                // $headers = "From: paras140902@gmail.com";

                // if (mail($to_email, $subject, $body, $headers)) {
                //     echo "Email successfully sent to $to_email...";
                // } else {
                //     echo "Email sending failed...";
                // }
            }
            mysqli_close($conn);
            echo("</div>");
            require("./Components/footer.php");
?>
    <script src="JS/script.js"></script>
    <script>
        let jsBookId=<?php echo json_encode($arr1); ?>;
        let jsBookPhoto=<?php echo json_encode($arr2); ?>;
        let jsSoldBook=<?php echo json_encode($arr3); ?>;
        for(let i=0;i<jsBookId.length;i++){
            let divInner1=document.getElementById("book-"+jsBookId[i]);
            divInner1.style.backgroundImage="url('"+jsBookPhoto[i]+"')";
            divInner1.style.backgroundSize="325px 350px";    
            let clickableDiv=document.getElementById("book-outer-"+jsBookId[i]);
            if(jsSoldBook[i]==true){
                divInner1.innerHTML="<img src='Images/sold-rubber-stamp-free-png.webp' height='320px' width='280px'>";
                clickableDiv.addEventListener("click",function(){
                    alert("Sorry, this book has been sold");
            });
            }else{
                clickableDiv.addEventListener("click",function(){
                window.location.href = "FullBookInfo.php?book_id="+jsBookId[i];
            });
            }
        }
        let jsValue=<?php echo json_encode($value); ?>;
        let jsType=<?php echo json_encode($type); ?>;
        let jsSearchType=document.getElementById("searchBy");
        let jsSearchValue=document.getElementById("search");
        if(jsType=="All"){
            jsSearchType.innerHTML="<option value='All' selected>All</option><option value='Book Name'>Book Name</option><option value='Author Name'>Author Name</option><option value='Publisher'>Publisher</option>";
        }else if(jsType=="Book Name"){
            jsSearchType.innerHTML="<option value='All'>All</option><option value='Book Name' selected>Book Name</option><option value='Author Name'>Author Name</option><option value='Publisher'>Publisher</option>";
        }else if(jsType=="Author Name"){
            jsSearchType.innerHTML="<option value='All'>All</option><option value='Book Name'>Book Name</option><option value='Author Name' selected>Author Name</option><option value='Publisher'>Publisher</option>";
        }else{
            jsSearchType.innerHTML="<option value='All'>All</option><option value='Book Name'>Book Name</option><option value='Author Name'>Author Name</option><option value='Publisher' selected>Publisher</option>";
        }
        jsSearchValue.setAttribute("value",jsValue);
    </script>
</body>
</HTML>