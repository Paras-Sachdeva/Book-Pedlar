<?php 
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed");
    }
    
            $headers = "From: paras140902@gmail.com\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $mail_sql1="SELECT * FROM book_notification";
            $mail_result1=mysqli_query($conn,$mail_sql1);
            $format1="<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Book Pedlar Notification</title>
            </head>
            <body>
                <div style='font-family: Arial, sans-serif;'>
                    <h2>Your Requested Book is Now Available on Book Pedlar!</h2>";
            $format2="<p>We're excited to inform you that the book you've been eagerly waiting for is now available on Book Pedlar! 📚</p>
            
            <h3>Book Details:</h3>";
            $format3="<p><strong>Negotiate and Purchase:</strong> If you're interested in purchasing the book, you can start a conversation with the seller to negotiate the price and arrange for the pickup or delivery. Simply log in to your Book Pedlar account and visit the book's page to initiate the conversation.</p>
            
            <p><strong>Act Fast!</strong> Books on Book Pedlar sell quickly, so don't miss this opportunity to grab your copy!</p>
    
            <p>Happy Reading! 📖</p>
            <p>Warm Regards,<br>Paras Sachdeva<br>Book Pedlar Team</p>
        </div>
    </body>
    </html>";

            while($mail_row1=mysqli_fetch_assoc($mail_result1)){
                $mail_sql2="SELECT * FROM book_data WHERE userid!=$mail_row1[userid]";
                $mail_result2=mysqli_query($conn,$mail_sql2);
                $mail_sql3="SELECT * FROM user_data WHERE id='$mail_row1[userid]'";
                $mail_result3=mysqli_query($conn,$mail_sql3);
                $mail_row3=mysqli_fetch_assoc($mail_result3);

                if($mail_row1['bookname']=="All" && $mail_row1['author']=="All" && $mail_row1['publisher']=="All"){
                    if($mail_row1['priceRange']=="all" && $mail_row1['bookcondition']=="all"){
                        while($mail_row2=mysqli_fetch_assoc($mail_result2)){
                            if($mail_row1['genre']==$mail_row2['genre']){
                                $to_email = $mail_row3['email'];
                                $subject = "Book Pedlar Notification";
                                $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;

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
                                $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;

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
                            if($mail_row1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                    $mail_result4=mysqli_query($conn,$mail_sql4);
                                    $mail_row4=mysqli_fetch_assoc($mail_result4);
                                    $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                    $mail_result4=mysqli_query($conn,$mail_sql4);
                                    $mail_row4=mysqli_fetch_assoc($mail_result4);
                                    $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='all' AND genre='all' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
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
                                $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;

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
                            if($mail_row1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND bookcondition='$mail_row1[bookcondition]' AND genre='all' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
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
                            if($mail_row1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                    $mail_result4=mysqli_query($conn,$mail_sql4);
                                    $mail_row4=mysqli_fetch_assoc($mail_result4);
                                    $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                    <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                    <li><strong>Author:</strong> $mail_row2[author]</li>
                                    <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                    <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                    <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                    <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                                </ul>
                        
                                <h3>Seller Details:</h3>
                                <ul>
                                    <li><strong>Name:</strong> $mail_row4[username]</li>
                                    <li><strong>Email:</strong> $mail_row4[email]</li>
                                </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='all' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000 && $mail_row1['genre']==$mail_row2['genre']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
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
                            if($mail_row1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='below500')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="500To1000"){
                                if($mail_row2['sellprice']>=500 && $mail_row2['sellprice']<=1000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='500To1000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="1000To2000"){
                                if($mail_row2['sellprice']>=1000 && $mail_row2['sellprice']<=2000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='1000To2000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="2000To3000"){
                                if($mail_row2['sellprice']>=2000 && $mail_row2['sellprice']<=3000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='2000To3000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="3000To4000"){
                                if($mail_row2['sellprice']>=3000 && $mail_row2['sellprice']<=4000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='3000To4000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="4000To5000"){
                                if($mail_row2['sellprice']>=4000 && $mail_row2['sellprice']<=5000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
                                    if(mail($to_email, $subject, $body, $headers)){
                                        echo "Email successfully sent to $to_email...";
                                    }else{
                                        echo "Email sending failed...";
                                    }
                                    $mail_sql4="DELETE FROM book_notification WHERE (userid='$mail_row1[userid]' AND bookname='All' AND author='All' AND publisher='All' AND genre='$mail_row1[genre]' AND bookcondition='$mail_row1[bookcondition]' AND priceRange='4000To5000')";
                                    mysqli_query($conn,$mail_sql4);
                                }
                            }else if($mail_row1['priceRange']=="Above5000"){
                                if($mail_row2['sellprice']>=5000 && $mail_row1['genre']==$mail_row2['genre'] && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $mail_sql4="SELECT * FROM user_data WHERE id=$mail_row2[userid]";
                                $mail_result4=mysqli_query($conn,$mail_sql4);
                                $mail_row4=mysqli_fetch_assoc($mail_result4);
                                $body = $format1."<p>Dear $mail_row3[username],</p>".$format2."<ul>
                                <li><strong>Title:</strong> $mail_row2[bookname]</li>
                                <li><strong>Author:</strong> $mail_row2[author]</li>
                                <li><strong>Publisher:</strong> $mail_row2[publisher]</li>
                                <li><strong>Price:</strong> ₹$mail_row2[sellprice]</li>
                                <li><strong>Genre:</strong> $mail_row2[genre]</li>
                                <li><strong>Condition:</strong> $mail_row2[bookcondition]</li>
                            </ul>
                    
                            <h3>Seller Details:</h3>
                            <ul>
                                <li><strong>Name:</strong> $mail_row4[username]</li>
                                <li><strong>Email:</strong> $mail_row4[email]</li>
                            </ul>".$format3;
    
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