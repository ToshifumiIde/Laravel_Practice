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
    {{-- <h1>Hello/Index</h1> --}}
    {{-- <p>{{$msg}}</p> --}}
    {{-- <p>{{$id}}</p> --}}
    {{-- <?php echo $msg ; ?> --}}
    {{-- @php echo $msg @endphp --}}
    {{-- <p>{{$name}}</p> --}}
    {{-- <ul>
        @foreach($data as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul> --}}
    {{-- HelloController.phpのotherアクションメソッドにreturn Storage::download()を実行した場合、下記でDL可能 --}}
    {{-- <p><a href="/hello/other">ダウンロード</a></p> --}}
    {{-- fileアップロード用のform --}}
    {{-- <form action="/hello/other" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <input type="submit">
    </form> --}}
    {{-- 1-4 request and response --}}
    <h1>Hello/Index</h1>
    <p>{{$msg}}</p>
    <form action="/hello" method="get">
    @csrf
    <div class="">
        <div class="">
            <label for="name">NAME :</label>
            <input type="text" name="name" id="name" value="{{old('name')}}">
        </div>
        <div class="">
            <label for="mail">MAIL :</label>
            <input type="mail" name="mail" id="mail" value="{{old('mail')}}">
        </div>
        <div class="">
            <label for="tel">TEL :</label>
            <input type="tel" name="tel" id="tel" value="{{old('tel')}}">
        </div>
        <input type="submit">
    </div>
    </form>
    <hr>
    <ol>
        @for($i=0;$i < count($keys) ;$i++)
        <li>
            {{$keys[$i]}} : {{$values[$i]}}
        </li>
        @endfor
    </ol>
</body>
</html>
