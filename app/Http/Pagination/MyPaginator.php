<?php
// カスタムナビゲーションリンクの作成
namespace App\Http\Pagination;

use Illuminate\Contracts\Pagination\Paginator;

class MyPaginator {
    private $paginator;

    // __construct(){}でPaginatorインスタンスを受け取る
    public function __construct(Paginator $paginator) {
        $this->paginator = $paginator;
    }

    // __construct(){}で受け取ったインスタンスを利用してlinkメソッドでhtmlタグを生成
    public function link() {
        $prev   = $this->paginator->currentPage() == 1 ? "disabled" : "";
        $next   = $this->paginator->currentPage() == $this->paginator->count() ? "disabled" : "";
        $result = '<ul class="pagination" role="navigation">';
        $result .= '<li class="page-item' . $prev . '"><a class="page-link" href="' . $this->paginator->previousPageUrl() . '">←前のページ</li>';
        $result .= '<li class ="page-item disabled"><a class="page-link">' . $this->paginator->currentPage() . '</a></li>';
        $result .= '<li class="page-item' . $next . '"><a class="page-link" href="' . $this->paginator->nextPageUrl() . '">次のページ→</a></li>';
        $result .= "</ul>";
        return $result;
    }
}
// 作成したカスタムリンクナビゲーションは、HelloController.phpで取得する
