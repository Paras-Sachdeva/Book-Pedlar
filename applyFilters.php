<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Search Results</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=9">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <?php
            require("./Components/loader.php");  //Loader Component

            echo('<div class="content">');
    
            require("./Components/header.php");  //Header Component

            $priceRangeSet=$_REQUEST["priceRange"];
            $genreSet=$_REQUEST["genre"];
            $bookConditionSet=$_REQUEST["bookCondition"];

            if($priceRangeSet=="all" && $genreSet=="all" && $bookConditionSet=="all"){
                $whereConditionFilter="";
            }else if($priceRangeSet=="all" && $genreSet=="all" && $bookConditionSet!="all"){
                $whereConditionFilter="AND bookcondition=$bookConditionSet";
            }else if($priceRangeSet=="all" && $genreSet!="all" && $bookConditionSet=="all"){
                $whereConditionFilter="AND genre='$genreSet'";
            }else if($priceRangeSet!="all" && $genreSet=="all" && $bookConditionSet=="all"){
                if($priceRangeSet=="below500"){
                    $whereConditionFilter="AND sellprice<=500";
                }else if($priceRangeSet=="500To1000"){
                    $whereConditionFilter="AND (sellprice>=500 AND sellprice<=1000)";
                }else if($priceRangeSet=="1000To2000"){
                    $whereConditionFilter="AND (sellprice>=1000 AND sellprice<=2000)";
                }else if($priceRangeSet=="2000To3000"){
                    $whereConditionFilter="AND (sellprice>=2000 AND sellprice<=3000)";
                }else if($priceRangeSet=="3000To4000"){
                    $whereConditionFilter="AND (sellprice>=3000 AND sellprice<=4000)";
                }else if($priceRangeSet=="4000To5000"){
                    $whereConditionFilter="AND (sellprice>=4000 AND sellprice<=5000)";
                }else if($priceRangeSet=="Above5000"){
                    $whereConditionFilter="AND sellprice>=5000";
                }
            }else if($priceRangeSet!="all" && $genreSet!="all" && $bookConditionSet!="all"){
                if($priceRangeSet=="below500"){
                    $whereConditionFilter="AND sellprice<=500 AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="500To1000"){
                    $whereConditionFilter="AND (sellprice>=500 AND sellprice<=1000) AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="1000To2000"){
                    $whereConditionFilter="AND (sellprice>=1000 AND sellprice<=2000) AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="2000To3000"){
                    $whereConditionFilter="AND (sellprice>=2000 AND sellprice<=3000) AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="3000To4000"){
                    $whereConditionFilter="AND (sellprice>=3000 AND sellprice<=4000) AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="4000To5000"){
                    $whereConditionFilter="AND (sellprice>=4000 AND sellprice<=5000) AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="Above5000"){
                    $whereConditionFilter="AND sellprice>=5000 AND genre='$genreSet' AND bookcondition='$bookConditionSet'";
                }
            }else if($priceRangeSet!="all" && $genreSet!="all" && $bookConditionSet=="all"){
                if($priceRangeSet=="below500"){
                    $whereConditionFilter="AND sellprice<=500 AND genre='$genreSet'";
                }else if($priceRangeSet=="500To1000"){
                    $whereConditionFilter="AND (sellprice>=500 AND sellprice<=1000) AND genre='$genreSet'";
                }else if($priceRangeSet=="1000To2000"){
                    $whereConditionFilter="AND (sellprice>=1000 AND sellprice<=2000) AND genre='$genreSet'";
                }else if($priceRangeSet=="2000To3000"){
                    $whereConditionFilter="AND (sellprice>=2000 AND sellprice<=3000) AND genre='$genreSet'";
                }else if($priceRangeSet=="3000To4000"){
                    $whereConditionFilter="AND (sellprice>=3000 AND sellprice<=4000) AND genre='$genreSet'";
                }else if($priceRangeSet=="4000To5000"){
                    $whereConditionFilter="AND (sellprice>=4000 AND sellprice<=5000) AND genre='$genreSet'";
                }else if($priceRangeSet=="Above5000"){
                    $whereConditionFilter="AND sellprice>=5000 AND genre='$genreSet'";
                }
            }else if($priceRangeSet=="all" && $genreSet!="all" && $bookConditionSet!="all"){
                $whereConditionFilter="AND (genre=$genreSet AND bookcondition=$bookConditionSet)";
            }else if($priceRangeSet!="all" && $genreSet=="all" && $bookConditionSet!="all"){
                if($priceRangeSet=="below500"){
                    $whereConditionFilter="AND sellprice<=500 AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="500To1000"){
                    $whereConditionFilter="AND (sellprice>=500 AND sellprice<=1000) AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="1000To2000"){
                    $whereConditionFilter="AND (sellprice>=1000 AND sellprice<=2000) AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="2000To3000"){
                    $whereConditionFilter="AND (sellprice>=2000 AND sellprice<=3000) AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="3000To4000"){
                    $whereConditionFilter="AND (sellprice>=3000 AND sellprice<=4000) AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="4000To5000"){
                    $whereConditionFilter="AND (sellprice>=4000 AND sellprice<=5000) AND bookcondition='$bookConditionSet'";
                }else if($priceRangeSet=="Above5000"){
                    $whereConditionFilter="AND sellprice>=5000 AND bookcondition='$bookConditionSet'";
                }
            }

            // <!-- Navigation List -->
            if(isset($_SESSION['userid'])){
                echo("<div class='navList'>
                            <a href='dashboard.php' class='linkAni'>Profile</a>
                            <a href='addBook.php' class='linkAni'>Add Book</a>
                            <a href='messages.php' class='linkAni'>Messages</a>
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
            
                        $type=$_REQUEST["typeSend"];
                        $value=$_REQUEST["valueSend"];
                        $capitalize_value=ucwords($value);
                        $keywords = explode(' ', $capitalize_value);

                        if($value==""){
                            $whereClause="userid!=$userid ".$whereConditionFilter;
                            $sql="SELECT * FROM book_data WHERE $whereClause";
                        }else if($type=="All"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'
                                                     OR author LIKE '%$keyword%'
                                                     OR publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR author='$capitalize_value' OR publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
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
                            $whereClause = "(bookname='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
                            $sql = "SELECT * FROM book_data WHERE $whereClause && userid!='$userid' ORDER BY
                            CASE
                            WHEN bookname='$capitalize_value' THEN 1 ELSE 2 END";
                        }else if($type=="Author Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "author LIKE '%$keyword%'";
                            }
                            $whereClause = "(author='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
                            $sql = "SELECT * FROM book_data WHERE $whereClause && userid!='$userid' ORDER BY
                            CASE
                            WHEN author='$capitalize_value' THEN 1 else 2 end";
                        }else if($type=="Publisher"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
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
            
                        $conn = mysqli_connect($host, $username, $password, $database);
                        if (!$conn) {
                            die("Connection failed");}
            
                        $type=$_REQUEST["typeSend"];
                        $value=$_REQUEST["valueSend"];
                        $capitalize_value=ucwords($value);
                        $keywords = explode(' ', $capitalize_value);
            
                        if($value==""){
                            if($whereConditionFilter!=""){
                                $whereClause=substr($whereConditionFilter,4);
                            }
                            else{
                                $whereClause="";
                            }
                            $sql="SELECT * FROM book_data WHERE $whereClause";
                        }else if($type=="All"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'
                                                     OR author LIKE '%$keyword%'
                                                     OR publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR author='$capitalize_value' OR publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
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
                            $whereClause = "(bookname='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
                            $sql = "SELECT * FROM book_data WHERE $whereClause ORDER BY
                            CASE
                            WHEN bookname='$capitalize_value' THEN 1 ELSE 2 END";
                        }else if($type=="Author Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "author LIKE '%$keyword%'";
                            }
                            $whereClause = "(author='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
                            $sql = "SELECT * FROM book_data WHERE $whereClause ORDER BY
                            CASE
                            WHEN author='$capitalize_value' THEN 1 else 2 end";
                        }else if($type=="Publisher"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).") ".$whereConditionFilter;
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
            echo("<div class='search-results'>Search Results</div>");
        ?>
            <div class="applyFilter">
                    <div id="filters-head">
                        <h3>Apply Filters</h3>
                    </div>
                    <div class="price-filter">
                        <form action="applyFilters.php" method="post" id="filter-form">
                        <label for="priceRange">Price Range</label>
                        <select id="priceRangeFilter" name="priceRange">
                            <option value="all" selected>All</option>
                            <option value="below500">Below &#8377;500</option>
                            <option value="500To1000">&#8377;500 - &#8377;1000</option>
                            <option value="1000To1500">&#8377;1000 - &#8377;1500</option>
                            <option value="1500To2000">&#8377;1500 - &#8377;2000</option>
                            <option value="2000To2500">&#8377;2000 - &#8377;2500</option>
                            <option value="2500To3000">&#8377;2500 - &#8377;3000</option>
                            <option value="Above3000">Above &#8377;3000</option>
                        </select>
                    </div>
                    <div class="genre-filter">
                        <label for="genre">Genre</label>
                        <select id="genreFilter" name="genre">
                            <option value="all" selected>All</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                            <option value="Romance">Romance</option>
                            <option value="Science-Fiction (Sci-Fi)">Science Fiction (Sci-Fi)</option>
                            <option value="Educational">Educational</option>
                            <option value="Current Affairs">Current Affairs</option>
                            <option value="Technology">Technology</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Horror">Horror</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Historical Fiction">Historical Fiction</option>
                            <option value="Biography">Biography</option>
                            <option value="Autobiography">Autobiography</option>
                            <option value="Poetry">Poetry</option>
                            <option value="Self Help">Self-Help</option>
                            <option value="Business & Economics">Business & Economics</option>
                            <option value="Science">Science</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Travel">Travel</option>
                            <option value="Children">Children's</option>
                            <option value="Young Adult">Young Adult</option>
                            <option value="Classics">Classics</option>
                        </select>
                    </div>
                    <div class="condition-filter">
                        <label for="bookCondition">Book Condition</label>
                        <select id="bookConditionFilter" name="bookCondition" style="margin-right:0;">
                            <option value="all" selected>All</option>
                            <option value="New">New</option>
                            <option value="Like New">Like New</option>
                            <option value="Very Good">Very Good</option>
                            <option value="Good">Good</option>
                            <option value="Acceptable">Acceptable</option>
                            <option value="Fair">Fair</option>
                            <option value="Poor">Poor</option>
                        </select>
                        <input type="hidden" name="typeSend" value="<?php echo($type); ?>">
                        <input type="hidden" name="valueSend" value="<?php echo($value); ?>">
                        </form>
                    </div>
            </div>   
        <?php
            echo("<div class='outside-all-books' style='display: flex;flex-wrap: wrap;padding-left: 10rem;padding-right: 10rem;padding-top: 2rem;'>");
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
                echo("<div class='book-outer' id='book-outer-$book_id4'>
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
                if(isset($_SESSION['userid'])){
                    echo("<div id='notify-text' style='width:100%;'><h4 style='text-align:center;'>No Books match your search.<br><br> Tap on \"NOTIFY ME\" to get personalized e-mail whenever this book becomes available.</h4></div>");
                    echo("<div><button id='notify-btn'>Notify Me</button></div>");
                }else{
                    echo("<div id='notify-text' style='width:100%;'><h4 style='text-align:center;'>No Books match your search.<br><br> Sign Up / Login to get personalized e-mail whenever this book becomes available.</h4></div>");
                    echo("<div><button id='signin-notify-btn'>Sign Up</button><button id='login-notify-btn'>Login</button></div>");
                }
            }
            mysqli_close($conn);
            echo("</div>");
            require("./Components/footer.php");
?>
    <script src="JS/script.js"></script>
    <script>
        // Display Book Pics
        let jsBookId=<?php echo json_encode($arr1); ?>;
        let jsBookPhoto=<?php echo json_encode($arr2); ?>;
        let jsSoldBook=<?php echo json_encode($arr3); ?>;
        var sessionVarCheck = "<?php echo isset($_SESSION['userid']) ? $_SESSION['userid'] : ''; ?>";
        console.log(sessionVarCheck); 
        for(let i=0;i<jsBookId.length;i++){
            let divInner1=document.getElementById("book-"+jsBookId[i]);
            divInner1.style.backgroundImage="url('"+jsBookPhoto[i]+"')";
            divInner1.style.backgroundSize="280px 325px";    
            let clickableDiv=document.getElementById("book-outer-"+jsBookId[i]);
            if(jsSoldBook[i]==true){
                divInner1.innerHTML="<img src='Images/sold-rubber-stamp-free-png.webp' height='320px' width='280px'>";
                clickableDiv.addEventListener("click",function(){
                    alert("Sorry, this book has been sold");
            });
            }else{
                clickableDiv.addEventListener("click",function(){
                if(sessionVarCheck!=''){
                    window.location.href = "FullBookInfo.php?book_id="+jsBookId[i]+"&again=0";
                }else{
                    window.location.href="signupPage.php";
                }
            });
            }
        }

        // Change Default Values for Search Bar Select
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

        // Apply Filters
        let filtersSubmitButton=document.getElementById("filters-head");
        let filtersForm=document.getElementById("filter-form");
        filtersSubmitButton.addEventListener("click",function(){
            filtersForm.submit();
        });

        // Notify Me or Sign In Button Click
        let signInNotifybtn=document.getElementById("signin-notify-btn");
        let loginNotifybtn=document.getElementById("login-notify-btn");
        let notifyBtn=document.getElementById("notify-btn");
        signInNotifybtn.addEventListener("click",function(){
            window.location.href="signupPage.php";
        });
        loginNotifybtn.addEventListener("click",function(){
            window.location.href="loginPage.php";
        });
        notifyBtn.addEventListener("click",function(){
        });

        // Change Default values for Filter select
        let jsPriceRange=<?php echo json_encode($priceRangeSet); ?>;
        let jsGenre=<?php echo json_encode($genreSet); ?>;
        let jsBookCondition=<?php echo json_encode($bookConditionSet); ?>;
        let jsPriceRangeFilter=document.getElementById("priceRangeFilter");
        let jsGenreFilter=document.getElementById("genreFilter");
        let jsBookConditionFilter=document.getElementById("bookConditionFilter");
        if(jsPriceRange=="all"){
            jsPriceRangeFilter.innerHTML="<option value='all' selected>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="below500"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500' selected>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="500To1000"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000' selected>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="1000To2000"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000' selected>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="2000To3000"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000' selected>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="3000To4000"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000' selected>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="4000To5000"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000' selected>&#8377;4000 - &#8377;5000</option><option value='Above5000'>Above &#8377;5000</option>";
        }else if(jsPriceRange=="Above5000"){
            jsPriceRangeFilter.innerHTML="<option value='all'>All</option><option value='below500'>Below &#8377;500</option><option value='500To1000'>&#8377;500 - &#8377;1000</option><option value='1000To2000'>&#8377;1000 - &#8377;2000</option><option value='2000To3000'>&#8377;2000 - &#8377;3000</option><option value='3000To4000'>&#8377;3000 - &#8377;4000</option><option value='4000To5000'>&#8377;4000 - &#8377;5000</option><option value='Above5000' selected>Above &#8377;5000</option>";
        }

        
        if(jsGenre=="all"){
            jsGenreFilter.innerHTML="<option value='all' selected>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Fiction"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction' selected>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Non-Fiction"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction' selected>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Romance"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction' selected>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance' selected>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Science-Fiction (Sci-Fi)"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance' selected>Romance</option><option value='Science-Fiction (Sci-Fi)' selected>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Educational"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational' selected>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Current Affairs"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs' selected>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Technology"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology' selected>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Fantasy"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy' selected>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Horror"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror' selected>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Thriller"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller' selected>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Historical Fiction"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction' selected>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Biography"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography' selected>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Autobiography"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography' selected>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Poetry"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry' selected>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Self Help"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help' selected>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Business & Economics"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics' selected>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Science"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science' selected>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Philosophy"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy' selected>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Travel"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel' selected>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Children"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children' selected>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Young Adult"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult' selected>Young Adult</option><option value='Classics'>Classics</option>";
        }else if(jsGenre=="Classics"){
            jsGenreFilter.innerHTML="<option value='all'>All</option><option value='Fiction'>Fiction</option><option value='Non-Fiction'>Non-Fiction</option><option value='Romance'>Romance</option><option value='Science-Fiction (Sci-Fi)'>Science Fiction (Sci-Fi)</option><option value='Educational'>Educational</option><option value='Current Affairs'>Current Affairs</option><option value='Technology'>Technology</option><option value='Fantasy'>Fantasy</option><option value='Horror'>Horror</option><option value='Thriller'>Thriller</option><option value='Historical Fiction'>Historical Fiction</option><option value='Biography'>Biography</option><option value='Autobiography'>Autobiography</option><option value='Poetry'>Poetry</option><option value='Self Help'>Self-Help</option><option value='Business & Economics'>Business & Economics</option><option value='Science'>Science</option><option value='Philosophy'>Philosophy</option><option value='Travel'>Travel</option><option value='Children'>Children's</option><option value='Young Adult'>Young Adult</option><option value='Classics' selected>Classics</option>";
        }

        if(jsBookCondition=="all"){
            jsBookConditionFilter.innerHTML="<option value='all' selected>All</option><option value='New'>New</option><option value='Like New'>Like New</option><option value='Very Good'>Very Good</option><option value='Good'>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair'>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="New"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New' selected>New</option><option value='Like New'>Like New</option><option value='Very Good'>Very Good</option><option value='Good'>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair'>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="Like New"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New'>New</option><option value='Like New' selected>Like New</option><option value='Very Good'>Very Good</option><option value='Good'>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair'>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="Very Good"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New'>New</option><option value='Like New'>Like New</option><option value='Very Good' selected>Very Good</option><option value='Good'>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair'>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="Good"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New'>New</option><option value='Like New'>Like New</option><option value='Very Good'>Very Good</option><option value='Good' selected>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair'>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="Acceptable"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New'>New</option><option value='Like New'>Like New</option><option value='Very Good'>Very Good</option><option value='Good'>Good</option><option value='Acceptable' selected>Acceptable</option><option value='Fair'>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="Fair"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New'>New</option><option value='Like New'>Like New</option><option value='Very Good'>Very Good</option><option value='Good'>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair' selected>Fair</option><option value='Poor'>Poor</option>";
        }else if(jsBookCondition=="Poor"){
            jsBookConditionFilter.innerHTML="<option value='all'>All</option><option value='New'>New</option><option value='Like New'>Like New</option><option value='Very Good'>Very Good</option><option value='Good'>Good</option><option value='Acceptable'>Acceptable</option><option value='Fair'>Fair</option><option value='Poor' selected>Poor</option>";
        }
    </script>
</body> 
</HTML>