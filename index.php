<!-- Home Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Home Page</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php
        require("./Components/loader.php");  //Loader Component
    ?>
    <div class="content">
        <?php
            require("./Components/header.php");  //Header Component

            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "book_pedlar";

            $conn = mysqli_connect($host, $username, $password, $database);
            if (!$conn) {
                die("Connection failed");
            }

            $headers = "From: paras140902@gmail.com";
            $mail_sql1="SELECT * FROM book_notification";
            $mail_result1=mysqli_query($conn,$mail_sql1);
            $mail_sql2="SELECT * FROM book_data";
            $mail_result2=mysqli_query($conn,$mail_sql2);
            while($mail_row1=mysqli_fetch_assoc($mail_result1)){

                $mail_sql3="SELECT * FROM user_data WHERE id='$mail_row1[userid]'";
                $mail_result3=mysqli_query($conn,$mail_sql3);
                $mail_row3=mysqli_fetch_assoc($mail_result3);

                if($mail_row1['bookname']=="All" && $mail_row1['author']=="All" && $mail_row1['publisher']=="All"){
                    if($mail_row1['priceRange']=="all" && $mail_row1['bookcondition']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_row1['genre']==$mail_row2['genre']){
                                $to_email = $mail_row3['email'];
                                $subject = "Book Notification From Book Pedlar";
                                $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Genre: $mail_row1[genre]";

                                if(mail($to_email, $subject, $body, $headers)){
                                    echo "Email successfully sent to $to_email...";
                                }else{
                                    echo "Email sending failed...";
                                }
                                $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND priceRange='all' AND bookcondition='all' AND genre='$mail_row1[genre]')";
                                mysqli_query($conn,$mail_sql4);
                            }
                        }
                    }else if($mail_row1['priceRange']=="all" && $mail_row1['genre']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                $to_email = $mail_row3['email'];
                                $subject = "Book Notification From Book Pedlar";
                                $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Book Condition: $mail_row1[bookcondition]";

                                if(mail($to_email, $subject, $body, $headers)){
                                    echo "Email successfully sent to $to_email...";
                                }else{
                                    echo "Email sending failed...";
                                }
                                $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND priceRange='all' AND genre='all' AND bookcondition='$mail_row1[bookcondition]')";
                                mysqli_query($conn,$mail_sql4);
                            }
                        }
                    }else if($mail_row1['bookcondition']=="all" && $mail_row1['genre']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_sql1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below &#8377;500";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;500 - &#8377;1000";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;1000 - &#8377;2000";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;2000 - &#8377;3000";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;3000 - &#8377;4000";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;4000 - &#8377;5000";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above &#8377;5000";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='Above5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }
                        }
                    }else if($mail_row1['priceRange']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_row1['bookcondition']==$mail_row2['bookcondition'] && $mail_row1['genre']==$mail_row2['genre']){
                                $to_email = $mail_row3['email'];
                                $subject = "Book Notification From Book Pedlar";
                                $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Book Condition: $mail_row1[bookcondition], Genre: $mail_row1[bookcondition]";

                                if(mail($to_email, $subject, $body, $headers)){
                                    echo "Email successfully sent to $to_email...";
                                }else{
                                    echo "Email sending failed...";
                                }
                                $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND priceRange='all' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]')";
                                mysqli_query($conn,$mail_sql4);
                            }
                        }
                    }else if($mail_row1['genre']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_sql1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below &#8377;500, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;500 - &#8377;1000, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;1000 - &#8377;2000, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;2000 - &#8377;3000, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;3000 - &#8377;4000, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;4000 - &#8377;5000, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above &#8377;5000, Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='Above5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }
                        }
                    }else if($mail_row1['bookcondition']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_sql1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below &#8377;500, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;500 - &#8377;1000, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;1000 - &#8377;2000, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;2000 - &#8377;3000, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;3000 - &#8377;4000, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;4000 - &#8377;5000, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above &#8377;5000, Genre: $mail_row1[genre]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='Above5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }
                        }
                    }else{
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_sql1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below &#8377;500, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;500 - &#8377;1000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;1000 - &#8377;2000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;2000 - &#8377;3000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;3000 - &#8377;4000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: &#8377;4000 - &#8377;5000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_sql1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above &#8377;5000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='Above5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }
                        }
                    }
                }
            }
            
            $sql1="SELECT * FROM user_data";
            $result1=mysqli_query($conn,$sql1);
            $count1=mysqli_num_rows($result1);

            $sql2="SELECT * FROM book_data";
            $result2=mysqli_query($conn,$sql2);
            $count2=mysqli_num_rows($result2);

            $sql3="SELECT * FROM book_data WHERE bookstatus!='Sold'";
            $result3=mysqli_query($conn,$sql3);
            $count3=mysqli_num_rows($result3);

            // <!-- Navigation List -->
            if(isset($_SESSION['userid'])){
                echo("<div class='navList'>
                    <a href='dashboard.php' class='linkAni'>Profile</a>
                    <a href='addBook.php' class='linkAni'>Add Book</a>
                    <a href='messages.php' class='linkAni'>Messages</a>
                    <a href='about.html' class='linkAni'>About Us</a>
                </div>");
            }else{
                echo("<div class='navList'>
                        <a href='signupPage.php' class='linkAni'>Create Profile</a>
                        <a href='loginPage.php' class='linkAni'>Buy Books</a>
                        <a href='loginPage.php' class='linkAni'>Sell Books</a>
                        <a href='about.php' class='linkAni'>About Us</a>
                    </div>");
            }
            echo("</div>");  // Header Div
        ?>   
        <div class="outside-all-home-items">
            <div class="slider-container">
                <div class="slider">
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Second Hand Book Trading Platform.jpg" alt="Slide 0"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Steps.jpg" alt="Slide 1"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Step1.jpg" alt="Slide 2"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Step2.jpg" alt="Slide 3"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Step3.jpg" alt="Slide 3"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/LastStep.jpg" alt="Slide 4"></div>
                    </div>
                </div>
                <i class="fa-solid fa-circle-chevron-left prev-slide"></i>
                <i class="fa-solid fa-circle-chevron-right next-slide"></i>
            </div>
            <div class="ribbon">
                <div class="quote1">
                    <p>"Bringing Books to Life, Second Hand, First Choice"</p>
                </div>
            </div>
            <div class="user-book-stats">
                <div class="user-stats">
                    <div id="user-stats-no" class="counter" data-count='<?php echo($count1); ?>'>0</div>
                    <div class="user-stats-text">Users Registered</div>
                </div>
                <div class="book-stats">
                    <div id="book-stats-no" class="counter" data-count='<?php echo($count2); ?>'>0</div>
                    <div class="book-stats-text">Books Added</div>
                </div>
            </div>
            <div class="ribbon">
                <div class="quote2">
                    <p>"Cultivating Green Minds, One Book at a Time"</p>
                </div>
            </div>
            <div class="slider-container-books">
                <div class="slider-books" id="clickable-slide">
                    <?php
                        $i=0;
                        $arr1=array();
                        while($row3=mysqli_fetch_assoc($result3)){
                    ?>
                    <div class="slide-content-books" id='<?php echo($i); ?>'>
                        <div class="slide-img-books" id='<?php echo("Img".$i); ?>'></div>
                        <div class="slide-name-books" id='<?php echo("Name".$i); ?>'>
                            <p><b><?php echo($row3['bookname']); ?></b></p>
                        </div>
                    </div>
                    <?php
                            array_push($arr1,$row3['photo']);
                            $i++;
                        }
                    ?>
                </div>
            </div>
            <div class="ribbon">
                <div class="quote3">
                    <p>"Your Gateway to Affordable Reading Pleasure"</p>
                </div>
            </div>
            <!-- <div class="ribbon">
                <div class="quote4">
                    <p>"Building Bridges Between Book Lovers and Bargain Hunters"</p>
                </div>
            </div> -->
            <div class="faq">
                <div class="faq-head">
                    <h1>FAQs</h1>
                </div>
                <div class="question">
                    <div class="question-text">
                        What is Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    Book Pedlar is an online platform where individuals can buy and sell second-hand books. It provides a convenient marketplace for book enthusiasts to discover affordable literature and connect with fellow readers and sellers.
                </div>
                <div class="question">
                    <div class="question-text">
                        How does Book Pedlar work?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    Users can sign up or log in to Book Pedlar to create profiles and list their second-hand books for sale. Buyers can search for books using keywords, browse categories, and filter results based on various criteria. They can mark books as "INTERESTED" and communicate with sellers to negotiate prices and arrange transactions.
                </div>
                <div class="question">
                    <div class="question-text">
                        Is it free to use Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    Yes, signing up and browsing listings on Book Pedlar is completely free. There is no fees for browsing, searching, or communicating with sellers.
                </div>
                <div class="question">
                    <div class="question-text">
                        How do I list a book for sale on Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    To list a book for sale, simply log in to your account and navigate to the "ADD BOOK" section. Fill out the book listing form with details such as title, author, condition, price, and upload images. Once submitted, your listing will be reviewed and published on the platform.
                </div>
                <div class="question">
                    <div class="question-text">
                        How do I buy a book on Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    To buy a book, browse through listings using the search bar or categories. Click on a listing to view detailed information about the book and the seller. If interested, you can mark the book as "interested" and communicate with the seller to negotiate prices and arrange the transaction.
                </div>
                <div class="question">
                    <div class="question-text">
                        Can I return a book if I'm not satisfied with it?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    Book Pedlar's aim is to provide an interface between buyers and sellers. The return policy may vary depending on the seller's terms and conditions. Buyers are encouraged to communicate with sellers and clarify return policies before making a purchase.
                </div>
                <div class="question">
                    <div class="question-text">
                        How do I contact a seller on Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    When you mark a particular book as "INTERESTED", a notification will be sent to the seller of that book. It depends on the seller to approve your request or not. Once the seller approves the notification, a conversation between you and the seller will be initiated, allowing you to communicate and negotiate transaction details.
                </div>
                <div class="question">
                    <div class="question-text">
                        Is my personal information safe on Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    Book Pedlar takes user privacy and security seriously. Your personal information is protected using industry-standard encryption protocols. However, it's essential to exercise caution when sharing sensitive information.
                </div>
                <div class="question">
                    <div class="question-text">
                        Can I sell other items besides books on Book Pedlar?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    Currently, Book Pedlar focuses exclusively on facilitating the buying and selling of second-hand books. However, the platform may consider expanding its offerings in the future based on user feedback and market demand.
                </div>
                <div class="question">
                    <div class="question-text">
                        What if I don't find the book I search for?
                    </div>
                    <div class="question-icon">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                </div>
                <div class="answer">
                    If you are not able to find your desired book, you can click on "NOTIFY ME". In future, when that book is uploaded by any user, you will get a personalized e-mail to inform you.
                </div>
            </div>
        </div>
        <?php
            require("./Components/footer.php");  //Footer Component
        ?>
    </div>

    <!-- JavaScript -->
    <script src="JS/script.js"></script>
    <script>
        // Image Slider
        $(document).ready(function() {
            var slideIndex = 0;
            var slides = $('.slide');
            var totalSlides = slides.length;
            var slideInterval = 4000; // 4 seconds
            var slideTimer;

            // Function to move to the next slide
            function nextSlide() {
            slideIndex = (slideIndex + 1) % totalSlides;
            updateSlider();
            }

            // Function to move to the previous slide
            function prevSlide() {
              slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
              updateSlider();
            }

            // Set interval to move to the next slide
            function startSlideTimer() {
              slideTimer = setInterval(nextSlide, slideInterval);
            }

            // Start the slide timer
            startSlideTimer();

            // Pause slide transition on hover
            $('.slider-container').hover(
                function() {
                clearInterval(slideTimer);
                },
                function() {
                startSlideTimer();
                }
            );

            // Previous slide button click event
            $('.prev-slide').click(function() {
              clearInterval(slideTimer);
              prevSlide();
              startSlideTimer();
            });

            // Next slide button click event
            $('.next-slide').click(function() {
              clearInterval(slideTimer);
              nextSlide();
              startSlideTimer();
            });

            // Function to update slider position
            function updateSlider() {
            var slideWidth = $('.slide').width();
            var slidePosition = -slideIndex * slideWidth;
            $('.slider').css('transform', 'translateX(' + slidePosition + 'px)');
            }
        });

        // Counting Animation
        function animateCounterOnScroll() {
            var counterElements = document.querySelectorAll(".counter");
            var countersStarted = {};

            function animateValue(id, start, end, duration) {
                var range = end - start;
                var stepTime = Math.abs(Math.floor(duration / range));
                var currentCount = start;
                var element = document.getElementById(id);
  
                function animate() {
                    currentCount += 1;
                    element.textContent = currentCount;
                    if (currentCount < end) {
                    setTimeout(animate, stepTime);
                    }
                }
                animate();
            }
            // Check if the counter element is visible in the viewport
            function isElementInViewport(el) {
                var rect = el.getBoundingClientRect();
                return (
                  rect.top >= 0 &&
                  rect.left >= 0 &&
                  rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                  rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }
            // Add scroll event listener to trigger animation for all counters
            window.addEventListener("scroll", function() {
                counterElements.forEach(function(counterElement) {
                    if (!countersStarted[counterElement.id] && isElementInViewport(counterElement)) {
                        animateValue(counterElement.id, 0, parseInt(counterElement.getAttribute("data-count")), 2000);
                        countersStarted[counterElement.id] = true; // Prevent animation from triggering multiple times
                    }
                });
            });
        }
        // Call the function when the DOM content is loaded
        document.addEventListener("DOMContentLoaded", animateCounterOnScroll);

        // Upload Book Pics
        let jsBookPics=<?php echo json_encode($arr1); ?>;
        for(let i=0;i<jsBookPics.length;i++){
            let jsBookPictag=document.getElementById("Img"+i);
            jsBookPictag.style.backgroundImage="url('Uploads/"+jsBookPics[i]+"')";
            jsBookPictag.style.backgroundSize="250px 310px";
        }

        // Change Animation Duration According to Number of Books
        var count = document.querySelectorAll('.slide-name-books').length;
        document.documentElement.style.setProperty('--count', count);
        console.log(count);

        // FAQs
        document.addEventListener('DOMContentLoaded', function() {
            const questions = document.querySelectorAll('.question');
            questions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('i.fa-chevron-up');
                    if (answer.style.display === 'block') {
                        answer.style.display = 'none';
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        answer.style.display = 'block';
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        });
    </script>
</body>
</html>