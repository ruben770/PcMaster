M.AutoInit();

//Media query Mobile menu
function resizeBody(x) {
    if (x.matches) { // If media query matches
        if (document.getElementById("body").classList.contains('container')) {

            document.getElementById("body").classList.remove('container');
        }
    }
    else {
        if (!document.getElementById("body").classList.contains('container')) {

            document.getElementById("body").classList.add('container');
        }
    }
}

let mediaQry = window.matchMedia("(max-width: 992px)")
resizeBody(mediaQry) // Call listener function at run time
mediaQry.addEventListener("change", resizeBody) // Attach listener function on state changes
