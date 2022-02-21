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
    {{-- <ul>
        <li id="name"></li>
        <li id="mail"></li>
        <li id="tel"></li>
    </ul> --}}
    {{-- <div class="">
        <input type="number" id="id" value="1">
        <button id="button">Click</button>
    </div> --}}

    <form action="/hello" method="post" >
        @csrf
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
        ID : <input type="text" id="id" name="id">
        <input type="submit">
    </form>
    <hr>
    <table border="1">
        @foreach($data as $item)
        <tr>
            <th>{{$item->id}}</th>
            {{-- <td>{{$item->name}}</td> --}}
            {{-- <td>{{$item->mail}}</td> --}}
            {{-- <td>{{$item->age}}</td> --}}

            {{-- 3-4 アクセサ(app/Person.phpの中で作成したgat~Attribute(){}メソッド)の呼び出し --}}
            {{-- <th>{{$item->name_and_id}}</th> --}}
            {{-- <th>{{$item->name_and_age}}</th> --}}
            {{-- <th>{{$item->name_and_mail}}</th>--}}
            <th>{{$item->all_data}}</th>
            {{-- 3-4 アクセサによるプロパティの変更の呼び出し(登録名の大文字表示) --}}
            {{-- <th>{{$item->name}}</th> --}}
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

{{-- <script src="{{asset('/js/index.js')}}"></script> --}}
{{-- <script>
    function doAction() {
        let id = document.getElementById("id").value;
        console.log(id);
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `/hello/json/${id}`, true);
        xhr.responseType = "json";
        console.log(xhr);
        xhr.onload = function (e) {
            if (this.status == 200) {
                let result = this.response;
                console.log(result);
                document.getElementById("name").textContent = result.name;
                document.getElementById("mail").textContent = result.mail;
                document.getElementById("age").textContent  = result.age;
            }
        };
        xhr.send();
    }

    document.getElementById("button").addEventListener("click", doAction);
</script> --}}
</body>
</html>
