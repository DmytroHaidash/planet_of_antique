@if ($errors->any())
    <div class="notification bg-danger text-white">
        <ul class="list-unstyled m-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))
    <div class="notification bg-success text-white">
        {!! Session::get('success') !!}
    </div>
@endif

@if(Session::has('message'))
    <div class="notification bg-info text-white">
        {!! Session::get('message') !!}
    </div>
@endif
