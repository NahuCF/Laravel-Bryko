///////////////////////////////////
// OPEN/CLOSE APPLICANTS IN INDEX//
///////////////////////////////////

var arrowDown = document.getElementsByClassName("fa-chevron-down");
var arrowUp = document.getElementsByClassName("fa-chevron-up");

var applicants = document.getElementsByClassName("applicants");

for(let i = 0; i < arrowDown.length; i++)
{
    arrowDown[i].addEventListener("click", () => {
        arrowDown[i].classList.toggle("arrow-active");
        arrowUp[i].classList.toggle("arrow-active");
        applicants[i].classList.toggle("applicants--visible");
    });
}


for(let i = 0; i < arrowUp.length; i++)
{
    arrowUp[i].addEventListener("click", () => {
        arrowDown[i].classList.toggle("arrow-active");
        arrowUp[i].classList.toggle("arrow-active");
        applicants[i].classList.toggle("applicants--visible");
    });
}
