<?php

namespace App\Http\Middleware;

use App\Facades\MyService;
use Closure;
use Illuminate\Http\Request;

// 2-3 ミドルウェア（before処理のみ）
// class MyMiddleware {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//      * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
//      */
//     public function handle(Request $request, Closure $next) {
//         $id = rand(0, count(MyService::allData()));
//         MyService::setId($id);
//         $merge_data = [
//             "id"      => $id,
//             "msg"     => MyService::say(),
//             "allData" => MyService::allData(),
//         ];
//         // ミドルウェアで生成した$merge_dataを$requestにmergeする
//         $request->merge($merge_data);
//         return $next($request);
//     }
// }

// 2-3 middleware(after処理も追加)

class MyMiddleware {
    public function handle(Request $request, Closure $next) {
        // before処理開始
        $id = rand(0, count(MyService::allData()));
        MyService::setId($id);
        $merge_data = [
            "id"   => $id,
            "msg"  => MyService::say(),
            "allData" => MyService::allData(),
        ];
        $request->merge($merge_data);
        // before処理終了

        $response = $next($request);

        // after処理開始
        $content = $response->content();
        $content .= '<style>
            body { background:#eef; }
            p { font-size:18px; }
            li { color:red; font-weight:bold; }
            </style>';
        $response->setContent($content);
        // after処理終了

        return $response;
    }
}
