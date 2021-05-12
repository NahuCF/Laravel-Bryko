@extends("layout.app")

@section("title", "Create Job")

@section("content")
<body>
    <div class="create-container">
        <form class="create-form" action="{{ route("job.store") }}" method="POST">
            @csrf
            <div class="input">
                <label for="title">Title</label>
                <input id="title" type="text" name="title" axlength="30">

                @error("title")
                    {{ $message }}
                @enderror
            </div>

            <div class="input">
                <label for="description">Description</label>
                <textarea name="description"></textarea>

                @error("description")
                    {{ $message }}
                @enderror
            </div>

            <div class="create-form__bottom">
                <div class="input minsalary-container">
                    <label for="minsalary">Min Salary(USDk a year)</label>
                    <input id="minsalary" type="text" name="minsalary" maxlength="3">

                    @error("minsalary")
                        {{ $message }}
                    @enderror
                </div>

                <div class="input maxsalary-container">
                    <label for="maxsalary">Max Salary(USDk a year)</label>
                    <input id="maxsalary" type="text" name="maxsalary" maxlength="3">
                    

                    @error("maxsalary")
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="create-form__checkbox">
                <div>
                    <label for="fulltime">Fulltime</label>
                    <input id="fulltime" type="checkbox" name="fulltime" value=1>
                </div>
                <button class="create-form__submit" type="submit">Create Job</button>
            </div>
        </form>
    </div>
</body>
@endsection