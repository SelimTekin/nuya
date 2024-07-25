function upToTop(){
    window.scrollTo(0,0);
}
window.onscroll = function () {
    theScroll();
};
function theScroll() {
if (
    document.body.scrollTop > 40 ||
    document.documentElement.scrollTop > 40
) {
    rightBottom.style.display = "block";
} else {
    rightBottom.style.display = "none";
}
}