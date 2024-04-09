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
                            if($mail_row1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below ₹500";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹500 - ₹1000";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹1000 - ₹2000";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹2000 - ₹3000";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹3000 - ₹4000";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹4000 - ₹5000";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above ₹5000";
    
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
                            if($mail_row1['priceRange']=="below500"){
                                if($mail_row2['sellprice']<=500 && $mail_row1['bookcondition']==$mail_row2['bookcondition']){
                                    $to_email = $mail_row3['email'];
                                    $subject = "Book Notification From Book Pedlar";
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below ₹500, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹500 - ₹1000, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹1000 - ₹2000, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹2000 - ₹3000, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹3000 - ₹4000, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹4000 - ₹5000, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above ₹5000, Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below ₹500, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹500 - ₹1000, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹1000 - ₹2000, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹2000 - ₹3000, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹3000 - ₹4000, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹4000 - ₹5000, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above ₹5000, Genre: $mail_row1[genre]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Below ₹500, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹500 - ₹1000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹1000 - ₹2000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹2000 - ₹3000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹3000 - ₹4000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: ₹4000 - ₹5000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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
                                    $body = "Hi, the Book with the Following Description is Available on Book Pedlar Website. Hurry up before someone else grabs it! Price Range: Above ₹5000, Genre: $mail_row1[genre], Book Condition: $mail_row1[bookcondition]";
    
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