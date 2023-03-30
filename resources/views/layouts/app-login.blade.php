<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | GHFRParkNet.Id</title>

    @include('includes._styles')
</head>

<body class="hold-transition login-page bg-image">
    {{ $slot }}
    @include('includes._scripts')

</body>

</html>
