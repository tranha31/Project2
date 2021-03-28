var obj = document.getElementById("bell");
var d = document.getElementById("annouce");

obj.onmouseover = function(){
    d.style.display = "flex";
}

d.onmouseout = function(){
    d.style.display = "none";
}