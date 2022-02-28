<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Person;
use App\Jobs\Myjob;
use Illuminate\Support\Facades\Storage;


class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule) {
    // $schedule->command('inspire')->hourly();
    // // 4-3 タスクとスケジューラ Scheduleクラスのコマンド実行
    // $schedule->exec("./mycmd.sh");
    // // これでプロジェクトのルートディレクトリに自作したmycmd.shを
    // // $ php artisan schedule:runコマンドで実行できる様になった

    // 4-3 タスクとスケジューラ Artisanコマンドを実行する「command」メソッド
    // $schedule->command("queue:work --stop-when-empty");

    // 4-3 タスクとスケジューラ クロージャーで実行する
    // $count = Person::get()->count();
    // $id = rand(0, $count) + 1;
    // $schedule->call(function () use ($id) {
    //     $person = Person::find($id);
    //     MyJob::dispatch($person);
    // });

    // 4-3 invokeクラスの呼び出し
    // $count = Person::all()->count();
    // $id = rand(0, $count) + 1;
    // $obj = new ScheduleObj($id);
    // $schedule->call($obj);


    // ディスパッチする場合
    // $count = Person::all()->count();
    // $id = rand(0, $count) + 1;
    // $schedule->call(function () use ($id) {
    //     MyJob::dispatch($id);
    // });

    // インスタンスを実行する場合
    // $count = Person::all()->count();
    // $id = rand(0, $count()) + 1;
    // $schedule->call(new MyJob($id));
    // }

    // 4-3 ジョブメソッドによるジョブ実行
    public function schedule(Schedule $schedule) {
        $count = Person::get()->count();
        $id = rand(0, $count) + 1;
        $schedule->job(new MyJob($id));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}



class ScheduleObj {
    private $person;
    public function __construct($id) {
        $this->person = Person::find($id);
    }
    public function __invoke() {
        Storage::append("person_access_log.txt", $this->person->all_data);
        MyJob::dispatch($this->person);
        return true;
    }
}
