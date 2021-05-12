///////////////
// APPLY BTN //
///////////////
var applyBtns = document.getElementsByClassName("apply-btn");

for(let i = 0; i < applyBtns.length; i++)
{
    applyBtns[i].addEventListener("click", () =>
    {
        applyBtns[i].classList.add("apply-btn--applied");
    });
}
//////////////////////
// CLOSE/OPEN FORMS //
/////////////////////

var registerContainer = document.querySelector(".container-register");
var loginContainer = document.querySelector(".container-login");

// Register

document.querySelector("#btns-register").addEventListener("click", () => {
    registerContainer.classList.toggle("container-register--active")
});

document.querySelector(".register-exit").addEventListener("click", () => {
    registerContainer.classList.toggle("container-register--active")
});

// Login

document.querySelector("#btns-login").addEventListener("click", () => {
    loginContainer.classList.toggle("container-login--active")
});

document.querySelector(".login-exit").addEventListener("click", () => {
    loginContainer.classList.toggle("container-login--active")
});

//////////////////////
// TEMPORAL MESSAGE //
//////////////////////

var temporalMessage = document.querySelector(".registered-message");

document.querySelector(".tempora-message-exit").addEventListener("click", () => {
    temporalMessage.classList.toggle("registered-message--active")
});