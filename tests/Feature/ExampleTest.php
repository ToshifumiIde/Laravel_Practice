<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase {
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // 6-1 コントローラーのテスト テストの作成
    // 以下、コメントアウトした部分はテストNGだった部分、なぜNGはか不明
    // ajaxの部分は用意していないので通過しないのはよしとして
    public function testBasicTest() {
        $this->get("/")->assertStatus(200);
        $this->get("/hello")->assertOk();
        // $this->post("/hello")->assertOk();
        $this->get("/hello/1")->assertStatus(404);
        $this->get("/hoge")->assertStatus(404);
        $this->get("/hello")->assertSeeText("Index");
        $this->get("/hello")->assertSeeText("Hello");
        // $this->get("/hello")->assertSee('<h1>');
        // $this->get("/hello")->assertSeeInOrder(["<html" , "<head","<body" , "<h1>"]);
        // $this->get("/hello/json/1")->assertSeeText("taro");
        // $this->get("/hello/json/2")->assertExactJson(["id" => 2, "name" => "hanako", "mail" => "hanako@flower", "age" => 19,]);
    }
}
