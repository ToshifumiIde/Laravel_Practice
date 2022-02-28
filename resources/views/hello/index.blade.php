<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Hello/Index</h1>
<div class="">
    @if ($msg ?? "")
    <p>{{$msg}}</p>
    @endif
    @if ($id ?? "")
    <p>{{$id}}</p>
    @endif
</div>


<form action="/hello" method="post">
    @csrf
    ID :<input type="text" name="id" id="id">
    <input type="submit">
</form>

<div class="">
    <table>
        <tr><th>Name</th><th>Mail</th><th>Age</th></tr>
        @foreach ($data as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->mail}}</td>
            <td>{{$item->age}}</td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
