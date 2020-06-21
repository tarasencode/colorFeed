var colors = document.querySelectorAll('.color');
var hexString = "";
colors.forEach(function(color, index) {
    color.addEventListener("mouseenter", showHex);
    color.addEventListener("mouseleave", restoreHex);
    color.addEventListener("click", copyHex);
});

function showHex() {
    hexString = this.firstChild.innerHTML;
    this.firstChild.classList.toggle("hide");
    var rgbArray = this.style.backgroundColor.match(/rgba?\((\d{1,3}), ?(\d{1,3}), ?(\d{1,3})\)?(?:, ?(\d(?:\.\d?))\))?/);
    var luma = 0.2126 * rgbArray[1] + 0.7152 * rgbArray[2] + 0.0722 * rgbArray[3];
    if (luma < 150) {
        this.firstChild.style.color = "#fff";
    }
}

function restoreHex() {
    this.firstChild.innerHTML = hexString;
    this.firstChild.classList.toggle("hide");
}

function copyHex() {
    navigator.clipboard.writeText(this.firstChild.innerHTML.substr(1));
    
    this.firstChild.innerHTML = "Copied!";
}