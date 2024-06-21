@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="errors-message"></div>

@if (Session::has('message'))
    <p class="alert alert-info">{{ Session('message') }}</p>
@endif

@if (Session::has('success'))
    <p class="alert alert-success">{{ Session('success') }}</p>
@endif

@if (Session::has('error'))
    <p class="alert alert-danger">{{ Session('error') }}</p>
@endif
