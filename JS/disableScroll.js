window.onbeforeprint = function() {disableScroll()};

function disableScroll() {
        document.getElementById("backTop").style.display = "none";
}