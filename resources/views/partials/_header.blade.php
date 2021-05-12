<header>
    <div class="btns">
        @if(session("id"))
            <div>
                <a href="{{ route("index") }}"><button>Inicio</button></a>
                <a href="{{ route("job.index") }}"><button id="btns-logout">See applicants</button></a>
            </div>
            <div>
                <a href="{{ route("job.create") }}"><button id="btns-logout">Create a Job</button></a>
                <a href="{{ route("logout") }}"><button id="btns-logout">Log Out</button></a>
            </div>
        @else
            <a href="{{ route("index") }}"><button>Inicio</button></a>
            <button id="btns-login">Log In</button>
            <button id="btns-register">Register</button>
        @endif
    </div>
</header>
<div class="registered-message {{ session("registered") ? "registered-message--active" : '' }}">
    {{ session("registered") }}
    <i class="fas fa-times tempora-message-exit"></i>
</div>