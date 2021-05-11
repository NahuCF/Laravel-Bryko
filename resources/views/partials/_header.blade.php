<header>
    <div class="btns">
        <a href="{{ route("index") }}"><button>Inicio</button></a>
        @if(session("id"))
            <a href="{{ route("job.create") }}"><button id="btns-logout">Add a Job</button></a>
            <a href="{{ route("logout") }}"><button id="btns-logout">Log Out</button></a>
        @else
            <button id="btns-login">Log In</button>
            <button id="btns-register">Register</button>
        @endif
    </div>
</header>
<div class="registered-message {{ session("registered") ? "registered-message--active" : '' }}">
    {{ session("registered") }}
    <i class="fas fa-times tempora-message-exit"></i>
</div>