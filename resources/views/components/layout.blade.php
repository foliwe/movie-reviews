@props([
'title' => 'Reviews'
])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/css/app.css'])
    <title> Reviews - {{$title}}</title>
</head>

<body class="font-lato text-lg">
    {{$slot}}
</body>

</html>