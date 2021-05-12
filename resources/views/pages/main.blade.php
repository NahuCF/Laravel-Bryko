@extends("layout.app")

@section("title", "Main page")

@section("content")

<main id="main">
    <div class="jobs-container">
        @if(!count($jobs))
            There is no jobs yet...
        @else
            @foreach($jobs as $job)
                <div class="job">
                    <h3 class="job__title">{{ $job->title }}</h3>
                    <p class="job__salary">
                        @if($job->fulltime)
                        Fulltime  
                        @else
                        Partime
                        @endif
                    ${{ $job->minimun_salary }}k - ${{ $job->maximun_salary }}k
                    </p>
                    <div class="job__description">
                        <p>{{ $job->description }}</p>

                        <form action="{{ route("apply") }}" method="POST">
                            @csrf

                            @if(!empty($job->applied_users_ids))
                                @if(in_array(session("id"), json_decode($job->applied_users_ids, true)))
                                    <button class="apply-btn apply-btn--disable" style="pointer-events: none">Apply</button>
                                @else
                                <button class="apply-btn">Apply</button>
                                @endif
                            @else
                                <button class="apply-btn">Apply</button>
                            @endif

                            <input type="text" name="id" value="{{ $job->id }}" hidden>
                        </form>

                    </div>
                </div>
            @endforeach
        @endif
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