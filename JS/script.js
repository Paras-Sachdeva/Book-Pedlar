// Display loader for 1 sec
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        document.querySelector(".loader").style.display = "none";
        document.querySelector(".content").style.display = "block";
    }, 1000);
});

// Display Navigation List
let bars=document.querySelector('#bars');
let navLis=document.querySelector('.navList');
let icon=document.querySelector('#icons');
icon.addEventListener("click",()=>{
    if(navLis.style.visibility==""||navLis.style.visibility=="hidden"){
        navLis.style.visibility="visible";
        icon.innerHTML='<i class="fa-solid fa-xmark" id="bars"></i>';
    }
    else{
        navLis.style.visibility="hidden";
        icon.innerHTML=' <i class="fa-solid fa-bars" id="bars"></i>';

    } 
});


let iconClick=document.getElementById("searchingIcon");
        iconClick.addEventListener("click",function(){
            console.log("Search Icon is clicked");
            let FormData=document.getElementById("inputForm");
            FormData.submit();
        });