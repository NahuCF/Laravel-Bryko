@extends("layout.index")

@section("title", "Applicants")

@section("content")
<main id="main">
    <div class="jobs-container jobs-container--little-margin">
        @if(!count($jobsData))
            You will see the jobs that you posted here but... Create one first :)
        @else
            <h2 id="jobs-title">Your posted Jobs</h2>
            @for($i = 0; $i < count($jobsData); $i++)
                <div class="job">
                    <h3 class="job__title">{{ $jobsData[$i]["title"] }}</h3>
                    <p class="job__salary">
                        @if($jobsData[$i]["fulltime"])
                        Fulltime  
                        @else
                        Partime
                        @endif
                    ${{ $jobsData[$i]["minimun_salary"] }}k - ${{ $jobsData[$i]["maximun_salary"] }}k
                    </p>
                    <div class="job__description">
                        <p>{{ $jobsData[$i]["description"] }}</p>
                        <div class="left-comment">

                        </div>
                    </div>
                    <div class="arrows-container">
                        <i class="fas fa-chevron-down "></i>
                        <i class="fas fa-chevron-up arrow-active"></i>
                    </div>
                    <div class="applicants">
                        <div class="inside-aplicants">
                            @if(!empty($jobsData[$i]["applied_users_names"]))

                            @php
                                $decodeNames = json_decode($jobsData[$i]["applied_users_names"])
                            @endphp
                            
                            @for($x = 0; $x < count($decodeNames); $x++)
                                <form class="applicant-form" action="">
                                    @csrf
                                    <div class="aplicant-form__content">
                                        {{ $decodeNames[$x] }}
                                        <a href="#"><i class="fas fa-file-download"></i></a>
                                    </div>
                                </form>
                            @endfor
                            @else
                                Nobody applied :(
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        @endif
    </div>
</main>
@endsection