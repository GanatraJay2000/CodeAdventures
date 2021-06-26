$(".app").removeClass("clicked");   
const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
if (vw <= 786) {
  $(".app").removeClass("side-min");
} 
else {
  $(".sidebar").on("mouseenter", () => {
    if (!$(".app").hasClass("clicked")) $(".app").removeClass("side-min");
  }).on("mouseleave", () => {
    if (!$(".app").hasClass("clicked")) $(".app").addClass("side-min");
  });
}

$("#sideOpener").on("click",()=>{        
    $(".app").toggleClass("side-min");
    $(".app").toggleClass("clicked");        
})    
$(".sidebar ul li a.sideToggler").click(()=>{
  $(".app").toggleClass("side-min");
  $(".app").toggleClass("clicked");
})
