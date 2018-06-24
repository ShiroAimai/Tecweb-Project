window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        document.getElementById("backTop").style.display = "block";
    } else {
        document.getElementById("backTop").style.display = "none";
    }
}