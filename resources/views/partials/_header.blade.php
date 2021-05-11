<header>
    <div class="btns">
        <button id="btns-login">Log In</button>
        <button id="btns-register">Register</button>
    </div>
</header>
<div class="registered-message {{ session("registered") ? "registered-message--active" : '' }}">
    {{ session("registered") }}
    <i class="fas fa-times tempora-message-exit"></i>
</div>