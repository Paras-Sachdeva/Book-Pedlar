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
                $issetVar=1;
                echo("<div class='navList'>
                            <a href='dashboard.php' class='linkAni'>Profile</a>
                            <a href='addBook.php' class='linkAni'>Add Book</a>
                            <a href='messages.php' class='linkAni'>Messages</a>
                            <a href='about.html' class='linkAni'>About Us</a>
                        </div>");
                echo("</div>");  // Header Div
                        $host = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "book_pedlar";
                        $userid=$_SESSION['userid'];
            
                        $conn = mysqli_connect($host, $username, $password, $database);
                        if (!$conn) {
                            die("Connection failed");}
            
                        $type=$_REQUEST["selectValue"];
                        $str=$_REQUEST["searchInput"];
                        $value = str_replace("'", " ", $str);
                        // $value=htmlspecialchars($inputText);
                        $capitalize_value=ucwords($value);
                        $keywords = explode(' ', $capitalize_value);

                        $block_sql1="SELECT * FROM user_block WHERE blockedid=$userid";
                        $block_sql2="SELECT * FROM user_block WHERE userid=$userid";
                        $block_result1=mysqli_query($conn,$block_sql1);
                        $block_result2=mysqli_query($conn,$block_sql2);
                        $block_count1=mysqli_num_rows($block_result1);
                        $block_whereClause1=1;
                        $block_count2=mysqli_num_rows($block_result2);
                        $block_whereClause2=1;

                        while($block_row1=mysqli_fetch_assoc($block_result1)){
                            $block_whereClause1="";
                            if($block_count1>1){
                                $block_whereClause1.="userid!=$block_row1[userid] AND ";
                                $block_count1--;
                            }else if($block_count1==1){
                                $block_whereClause1.="userid!=$block_row1[userid]";
                                $block_count1--;
                            }
                        }
                        while($block_row2=mysqli_fetch_assoc($block_result2)){
                            $block_whereClause2="";
                            if($block_count2>1){
                                $block_whereClause2.="userid!=$block_row2[blockedid] AND ";
                                $block_count2--;
                            }else if($block_count2==1){
                                $block_whereClause2.="userid!=$block_row2[blockedid]";
                                $block_count2--;
                            }
                        }
                        
                        if($value==""){
                            $sql="SELECT * FROM book_data WHERE (userid!=$userid AND $block_whereClause1 AND $block_whereClause2)";
                        }else if($type=="All"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "bookname LIKE '%$keyword%'
                                                     OR author LIKE '%$keyword%'
                                                     OR publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(bookname='$capitalize_value' OR author='$capitalize_value' OR publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause AND $block_whereClause1 AND $block_whereClause2 AND userid!=$userid ORDER BY
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
                            $sql = "SELECT * FROM book_data WHERE $whereClause AND $block_whereClause1 AND $block_whereClause2 AND userid!='$userid' ORDER BY
                        CASE
                            WHEN bookname='$capitalize_value' THEN 1 ELSE 2 END";
                        }else if($type=="Author Name"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "author LIKE '%$keyword%'";
                            }
                            $whereClause = "(author='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause AND $block_whereClause1 AND $block_whereClause2 AND userid!='$userid' ORDER BY
                        CASE
                            WHEN author='$capitalize_value' THEN 1 else 2 end";
                        }else if($type=="Publisher"){
                            foreach ($keywords as $keyword) {
                                $whereConditions[] = "publisher LIKE '%$keyword%'";
                            }
                            $whereClause = "(publisher='$capitalize_value' OR ".implode(' OR ', $whereConditions).")";
                            $sql = "SELECT * FROM book_data WHERE $whereClause AND $block_whereClause1 AND $block_whereClause2 AND userid!='$userid' ORDER BY
                        CASE
                            WHEN publisher='$capitalize_value' THEN 1 else 2 end";
                        }
            }else{
                $issetVar=0;
                $userid=0;
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
                            $sql = "SELECT * FROM book_data WHERE $whereClause ORDER BY
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
            echo("<div class='search-results'>Search Results</div>");
        ?>
            <div class="applyFilter">
                    <div id="filters-head">
                        <h3>Apply Filters</h3>
                    </div>
                    <div class="price-filter">
                        <form action='applyFilters.php' method="POST" id="filter-form">
                        <label for="priceRange">Price Range</label>
                        <select id="priceRangeFilter" name="priceRange">
                            <option value="all" selected>All</option>
                            <option value="below500">Below &#8377;500</option>
                            <option value="500To1000">&#8377;500 - &#8377;1000</option>
                            <option value="1000To2000">&#8377;1000 - &#8377;2000</option>
                            <option value="2000To3000">&#8377;2000 - &#8377;3000</option>
                            <option value="3000To4000">&#8377;3000 - &#8377;4000</option>
                            <option value="4000To5000">&#8377;4000 - &#8377;5000</option>
                            <option value="Above5000">Above &#8377;5000</option>
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
                        <input type="hidden" name="valueSend" value="<?php echo($str); ?>">
                    </form>
                    </div>
            </div>   
        <?php
            echo("<div class='outside-all-books'>");
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
                                <div class='book-inner2'>
                                    <div class='heading-book' style='text-align:center;'>
                                        <b>\"$book_name4\"</b>
                                    </div>
                                    <div class='details-book'>
                                        <h5>Author</h5> $author4<br><br>
                                        <h5>Publisher</h5> $publisher4<br><br>
                                        <h5>Genre</h5> $genre4<br>
                                    </div>
                                    <div class='price-book'>
                                        <h2>&#x20b9;$sell_price4</h2><br>
                                        <h6>&#x20b9;$actual_price4</h6>
                                        <h4 style='color:green;'>$discount4%</h4><h4>off</h4>
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
            echo("</div>");
?>
        <div class="box" id="notifyMeBox" style="height: auto;">
            <div class="notify-head">
                <div class="notify-text"><h4>NOTIFY YOU?</h4></div>
                <div class="notify-close-icon" id="notify-close-icon">
                    <i class="fa-solid fa-square-xmark close-icon" title="Close Notification"></i>
                </div>
            </div>
            <div class="notify-content">
                <div class="notify-ques">
                    <h6>Do you want to be Notified when the following Book Description becomes Available?</h6>
                </div>
                <div class="book-characters">
                    <ul>
                        <form action="notifyMe.php" method="POST" id="notifyMeForm">
                            <?php
                                if($value==""){
                                    echo($boxText);
                                    $bookName_notify="All";
                                    $authorName_notify="All";
                                    $publisher_notify="All";
                                }else if($type=="All"){
                                    echo("<li>Book/Author/Publisher Name: $value</li>");
                                    $bookName_notify=$value;
                                    $authorName_notify=$value;
                                    $publisher_notify=$value;
                                }else if($type=="Book Name"){
                                    echo("<li>Book Name: $value</li>");
                                    $bookName_notify=$value;
                                    $authorName_notify="No";
                                    $publisher_notify="No";
                                }else if($type=="Author Name"){
                                    echo("<li>Author Name: $value</li>");
                                    $bookName_notify="No";
                                    $authorName_notify=$value;
                                    $publisher_notify="No";
                                }else{
                                    echo("<li>Publisher: $value</li>");
                                    $bookName_notify="No";
                                    $authorName_notify="No";
                                    $publisher_notify=$value;
                                }
                            ?>
                        </form>
                    </ul>
                </div>
            </div>
            <div class="notify-btns" style="margin-top: 1rem;">
                <button class="notify-btn-approve" id="notify-okay-btn">Okay</button>                    
                <button class="notify-btn-delete" id="notify-cancel-btn">Cancel</button>                    
            </div>
        </div>
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
        let jsValue=<?php echo json_encode($str); ?>;
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

        let issetVar = <?php echo json_encode($issetVar); ?>;
        if(issetVar==1){
            // Notify Me Click
            let notifyBtn=document.getElementById("notify-btn");
            notifyBtn.addEventListener("click",function(){
                let content = document.querySelector('.content');
                let box=document.getElementById("notifyMeBox");
                var viewportWidth = window.innerWidth;
                var viewportHeight = window.innerHeight;
                var centerX = viewportWidth / 2;
                var centerY = viewportHeight / 2;
    
                content.classList.add('blur');
                content.style.pointerEvents = 'none';
                document.body.style.overflow = 'hidden';
    
                box.style.display="flex";
                box.style.flexDirection="column";
                box.style.transform = 'scale(2)';
                box.style.position = 'fixed';
                box.style.left = centerX - box.offsetWidth / 2 + 'px';
                box.style.top = centerY - box.offsetHeight / 2 + 'px';
                let closeIcon=document.getElementById("notify-close-icon");
                closeIcon.addEventListener("click",function(){
                    box.style.display="none";
                    content.classList.remove('blur');
                    content.style.pointerEvents = 'auto';
                    document.body.style.overflow = 'auto';
                });
                let notifyCancel=document.getElementById("notify-cancel-btn");
                notifyCancel.addEventListener("click",function(){
                    box.style.display="none";
                    content.classList.remove('blur');
                    content.style.pointerEvents = 'auto';
                    document.body.style.overflow = 'auto';
                });
                let notifyOkay=document.getElementById("notify-okay-btn");
                notifyOkay.addEventListener("click",function(){
                    let userid = <?php echo json_encode($userid); ?>;
                    let bookName = <?php echo json_encode($bookName_notify); ?>;
                    let authorName = <?php echo json_encode($authorName_notify); ?>;
                    let publisher = <?php echo json_encode($publisher_notify); ?>;
                    let priceRange = "all";
                    let genre = "all"
                    let bookCondition = "all";
                    let jsNotifyMeObj={};
                    jsNotifyMeObj.userid=userid;
                    jsNotifyMeObj.bookName=bookName;
                    jsNotifyMeObj.authorName=authorName;
                    jsNotifyMeObj.publisher=publisher;
                    jsNotifyMeObj.priceRange=priceRange;
                    jsNotifyMeObj.genre=genre;
                    jsNotifyMeObj.bookCondition=bookCondition;
                    console.log(jsNotifyMeObj);
                    $.ajax({
                        url:"notifyMe.php",
                        method:"POST",
                        data:{ jsNotifyMeObj: JSON.stringify(jsNotifyMeObj)},
                            success:function(response){
                            console.log(response);
                        }
                    });
                    box.style.display="none";
                    content.classList.remove('blur');
                    content.style.pointerEvents = 'auto';
                    document.body.style.overflow = 'auto';
                });
            });
        }else{
            // Sign Up or Login Click
            let signInNotifybtn=document.getElementById("signin-notify-btn");
            let loginNotifybtn=document.getElementById("login-notify-btn");
            signInNotifybtn.addEventListener("click",function(){
                window.location.href="signupPage.php";
            });
            loginNotifybtn.addEventListener("click",function(){
                window.location.href="loginPage.php";
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>