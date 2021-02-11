<h4>Contact:</h4>

<p>{{ $data->user->name }}, {{ $data->user->phone }}, {{ $data->user->email }}</p>

@if ($data->message)
    <h4>Message:</h4>
    <p>{{ $data->message }}</p>
@endif

<br>
<p>-----<br>{{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}</p>