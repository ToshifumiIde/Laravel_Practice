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
    <table border="1">
        @foreach($data as $item)
        <tr>
            <th>{{$item->id}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->mail}}</td>
            <td>{{$item->age}}</td>
        </tr>
        @endforeach
    </table>
    {{--<ol>
        @foreach ($data as $item)
        <li>{{$item->name}} [{{$item->mail}} , {{$item->age}}]</li>
        @endforeach
    </ol>
    <hr> --}}
    {{-- {!!$data->links()!!} --}}
    {{-- {!!$paginator->link()!!} --}}
</body>
</html>
