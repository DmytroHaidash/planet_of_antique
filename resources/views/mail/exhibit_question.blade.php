<h4>Contact:</h4>

<p>{{ $data->user->name }}, {{ $data->user->phone }}, {{ $data->user->email }}</p>

<h4>Product:</h4>
<p>
    <a href="{{ route('client.exhibits.show', $exhibit) }}" target="_blank">{{ $exhibit->title }}</a>
</p>

@if ($data->message)
    <h4>Message:</h4>
    <p>{{ $data->message }}</p>
@endif

<br>
<p>-----<br>{{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}</p>