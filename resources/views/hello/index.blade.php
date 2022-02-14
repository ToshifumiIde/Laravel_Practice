<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        th{background: #ccc ; padding:10px;}
        td{background: #eee ; padding:10px;}
    </style>
</head>
<body>
    <h1>Hello/Index</h1>
    {{-- <p>{{$msg}}</p> --}}
    {{-- <p>{{$id}}</p> --}}
    {{-- <?php echo $msg ; ?> --}}
    @php
     echo $msg
    @endphp
    {{-- <p>{{$name}}</p> --}}
    <ul>
        @foreach($data as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
    {{-- HelloController.phpのotherアクションメソッドにreturn Storage::download()を実行した場合、下記でDL可能 --}}
    {{-- <p><a href="/hello/other">ダウンロード</a></p> --}}
    {{-- fileアップロード用のform --}}
    {{-- <form action="/hello/other" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <input type="submit">
    </form> --}}
</body>
</html>
