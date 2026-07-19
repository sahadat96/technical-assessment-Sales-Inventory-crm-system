<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>{{ $campaign->subject }}</title>

</head>

<body>

<h2>Hello {{ $campaign->customer->name }},</h2>

<p>

{{ $campaign->message }}

</p>

<hr>

<p>

Thank you for being our valued customer.

</p>

<p>

Regards,<br>

Sales CRM Team

</p>

</body>

</html>