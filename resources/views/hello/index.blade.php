<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <h1>Hello / Index</h1>
    <p>{{$msg}}</p>
    <ol>
        @foreach ($data as $item)
        <li>{{$item->name}} [{{$item->mail}} , {{$item->age}}]</li>
        @endforeach
    </ol>
    <hr>
    {{-- {!!$data->links()!!} --}}
    {!!$paginator->link()!!}
</body>
</html>
