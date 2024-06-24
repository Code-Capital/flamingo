<x-mail::message>
# Introduction
<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>

<p>{{ $data['message'] }}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
