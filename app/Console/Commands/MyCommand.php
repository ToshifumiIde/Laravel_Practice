<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Person;

class MyCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // 7-3 Artisanコマンドの開発
    // protected $signature = 'my:cmd {num?*}';
    // protected $signature = "my:cmd {--id=?} {--name=?}";


    // 7-3 Artisanコマンドを用いた石とりゲームの作成
    // protected $signature = 'my:cmd {--stones=15}{--max=3}';

    // 7-3 複数項目の選択
    protected $signature = "my:cmd";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This is my first command";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    // public function handle() {
    //     echo "\n*今日の格言*\n\n";
    //     echo Inspiring::quote();
    //     echo "\n\n";
    // }

    // 7-3 引数を追加した場合のartisanコマンドの中身の実装
    // public function handle(){
    //     $p = $this->argument("person");
    //     if($p != null){
    //         $person = Person::find($p);
    //         if($person != null){
    //             echo "\nPerson id = " . $p . ":\n";
    //             echo $person->all_data . "\n\n";
    //             return ;
    //         }
    //     }
    //     echo "can't get Person...";
    // }

    // 7-3 null許可{?}と可変超引数{*}を合わせた引数に対するartisanコマンドの作成{person?*}
    // public function handle() {
    //     $arr = $this->arguments();
    //     $re = 0;
    //     foreach ($arr["num"] as $item) {
    //         $re += (int) $item;
    //     }
    //     echo "total : " . $re . "\n";
    // }

    // 7-3 idとnameでPersonクラスを用いてpeopleテーブルからユーザー情報を取得
    // public function handle() {
    //     $id   = $this->option("id");
    //     $name = $this->option("name");
    //     if ($id != "?") {
    //         $p = Person::find($id);
    //     } else {
    //         if ($name != "?") {
    //             $p = Person::where("name", $name)->first();
    //         } else {
    //             $p = null;
    //         }
    //     }
    //     if ($p != null) {
    //         echo "Person id = " . $p->id . ":\n" . $p->all_data;
    //     } else {
    //         echo "no Person find ...";
    //     }
    // }

    // 7-3 ミニゲームの作成（石とりゲーム）
    // public function handle() {
    //     $stones = $this->option("stones");
    //     $max    = $this->option("max");
    //     echo "*** start ***\n";
    //     while ($stones > 0) {
    //         echo ("stones: $stones\n");
    //         $ask = $this->ask("you:");
    //         $you = (int)$ask;
    //         $you = $you > 0 && $you <= $max ? $you : 1;
    //         $stones -= $you;
    //         echo ("stones: $stones\n");
    //         if ($stones <= 0) {
    //             echo "you lose...\n";
    //             break;
    //         }
    //         $me = ($stones - 1) % (1 + $max);
    //         $me = $me == 0 ? 1 : $me;
    //         $stones -= $me;
    //         echo "me: $me\n";
    //         if ($stones <= 0) {
    //             echo "you win!!\n";
    //             break;
    //         }
    //     }
    //     echo "---end---\n";
    // }

    // 7-3 複数項目の選択
    // public function handle() {
    //     $choice = ["id", "name", "age"];
    //     echo "find Person! \n";
    //     $field  = $this->choice("select field", $choice, 0);
    //     $value  = $this->ask("input value:");
    //     $person = Person::where($field, $value)->first();

    //     if ($person != null) {
    //         echo "id = " . $person->id . "\n";
    //         echo $person->all_data;
    //     } else {
    //         echo "can't find Person.";
    //     }
    // }

    // 7-3 複数項目の選択（出力文字列の装飾：$this->question()、$this->info()、$this->line()、$this->error()）
    // public function handle() {
    //     $choice = ["id", "name", "age"];
    //     $this->question("find Person!");
    //     $field = $this->choice("select field:", $choice, 1);
    //     $value = $this->ask("input value");
    //     $person = Person::where($field, $value)->first();

    //     if ($person != null) {
    //         $this->info("id = " . $person->id);
    //         $this->line($person->all_data);
    //     } else {
    //         $this->error("can't find person");
    //     }
    // }

    // 7-3 テーブル出力
    public function handle() {
        $min     = (int)$this->ask("min age:");
        $max     = (int)$this->ask("max age:");
        $headers = ["id", "name", "age", "mail"];
        $result  = Person::select($headers)
            ->where("age", ">=", $min)
            ->where("age", "<=", $max)
            ->orderBy("age")->get();
        if ($result->count() == 0) {
            $this->error("can't find Person.");
            return;
        }
        $data = $result->toArray();
        $this->table($headers, $data);
    }
}
