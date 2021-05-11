@extends("layout.app")

@section("title", "Main page")

@section("content")

<main id="main">
    <div class="jobs-container">
        @for($i = 0; $i < 10; $i++)
            <div class="job">
                <h3 class="job__title">Job Title</h3>
                <p class="job__salary">Fulltime 50k</p>
                <div class="job__description">
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum cum, possimus numquam dolores odio nesciunt quos explicabo obcaecati asperiores non adipisci in soluta, quas tenetur repellat? Earum ea distinctio modi.
                    </p>
                    <button class="apply-btn">Apply</button>
                </div>
            </div>
        @endfor
    </div>
</main>

@php 
    $registerError = false;
@endphp

@if($errors->any())
    @if($errors->has("username") || $errors->has("email") || $errors->has("password"))
        @php $registerError = true; @endphp
    @endif
@endif

{{-- REGISTER --}}

<div class="container-register {{ $registerError ? "container-register--active" : ''}}">
    <form class="session-form" action="{{ route("register") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Register</h2>
        <i class="fas fa-times register-exit"></i>
        <hr>

        <div class="input">
            <label for="username-register">Username</label>
            <input id="username-register" name="username" type="text" placeholder="Username">

            @if($registerError)
                @error("username")
                    {{ $message }}
                @enderror
            @endif
        </div>

        <div class="input">
            <label for="email-register">Email</label>
            <input id="email-register" name="email" type="text" placeholder="Email">

            @if($registerError)
                @error("email")
                    {{ $message }}
                @enderror
            @endif
        </div>

        <div class="input">
            <label for="password-register">Password</label>
            <input id="password-register" name="password" type="password" placeholder="Password">

            @if($registerError)
                @error("password")
                    {{ $message }}
                @enderror
            @endif
        </div>

        <div class="input">
            <div class="cv-btn">
                <label for="cv">CV</label>

                @if($registerError)
                    @error("cv")
                        {{ $message }}
                    @enderror
                @endif
            </div>
            <input id="cv" name="cv" type="file" hidden>
        </div>

        <button class="submit-btn" type="submit">Submit</button>
    </form>
</div>

{{-- LOGIN --}}

<div class="container-login">
    <form class="session-form" action="{{ route("login") }}" method="POST">
        @csrf
        <h2>Login</h2>
        <i class="fas fa-times login-exit"></i>
        <hr>

        <div class="input">
            <label for="username-login">Username</label>
            <input id="username-login" name="username-login" type="text" placeholder="Username">
        </div>

        <div class="input">
            <label for="password-login">Password</label>
            <input id="password-login" name="password-login" type="password" placeholder="Password">
        </div>

        <button class="submit-btn" type="submit">Submit</button>
    </form>
</div>

@endsection