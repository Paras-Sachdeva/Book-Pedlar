// Store Notification Details When User clicks Interested Button
            let InterestedBtn=document.getElementById("interested-btn");
            InterestedBtn.addEventListener("click",function(){
                alert("The Seller has been Notified, They will Contact You Shortly.\nCheck Your Message Box For Updates.");
                    let jsInterestedBook=<?php echo json_decode($selected_bookid); ?>;
                    let jsInterestedSeller=<?php echo json_decode($user_id7); ?>;
                    let jsInterestedBuyer=<?php echo json_decode($userid); ?>;
                    let jsObject={};
                    jsObject.bookId=jsInterestedBook;
                    jsObject.bookSeller=jsInterestedSeller;
                    jsObject.bookBuyer=jsInterestedBuyer;
                    $.ajax({
                        url:"sendNotification.php",
                        method:"POST",
                        data:{ jsObject: JSON.stringify(jsObject)},
                            success:function(response){
                                console.log(response);
                            }
                    });
            });