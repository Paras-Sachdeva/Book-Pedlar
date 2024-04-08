// Display loader for 1 sec
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        document.querySelector(".loader").style.display = "none";
        document.querySelector(".content").style.display = "block";
    }, 1000);
});

let bars=document.querySelector('#bars');
let navLis=document.querySelector('.navList');
let icon=document.querySelector('#icons');
let sliderContainer=document.querySelector('.slider-container');
icon.addEventListener("click",()=>{
    if(navLis.style.display=="none"){
        navLis.style.display="flex";
        navLis.style.justifyContent="space-around";
        navLis.style.alignItems="center";
        icon.innerHTML='<i class="fa-solid fa-xmark" id="bars-cross"></i>';
    }
    else{
        navLis.style.display="none";
        icon.innerHTML=' <i class="fa-solid fa-bars" id="bars"></i>';
    } 
});

// Search Book Functionality
let iconClick=document.getElementById("searchingIcon");
    iconClick.addEventListener("click",function(){
        console.log("Search Icon is clicked");
        let FormData=document.getElementById("inputForm");
        FormData.submit();
    });