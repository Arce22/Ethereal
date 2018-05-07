// When the user clicks on div, open the popup
function popUpAppear() {
    var popup = document.getElementById("littlePopup");
    popup.classList.toggle("show");
    popup.addEventListener('webkitAnimationEnd',function( event ) { popup.classList.toggle("show"); }, false);
}