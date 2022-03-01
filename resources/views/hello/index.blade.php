{{-- <!DOCTYPE html>
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
</html> --}}

{{-- 5-1 Vueの使用 --}}
{{-- <!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="padding:10px;">

<h1>Hello/Index</h1>
<p>{{$msg}}</p>
<div id="app">
    <example-component></example-component>
    <my-component></my-component>
</div>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html> --}}

{{-- 5-2 Reactの使用 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}" type="text/css">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
</head>
<body>
<h1>Hello/Index</h1>
<p>{{$msg}}</p>

<ul>
    @foreach ($data as $item)
    <li>
        {{$item->name}} : {{$item->email}}({{$item->age}})
    </li>
    @endforeach
</ul>
<div id="example"></div>
<div id="mycomponent"></div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
