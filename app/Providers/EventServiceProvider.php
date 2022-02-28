<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    // protected $listen = [
    //     Registered::class => [
    //         SendEmailVerificationNotification::class,
    //     ],
    //     "App\Events\PersonEvent" => [
    //         // "App\Listeners\PersonEventListener",

    //     ],
    // ];
    // protected $subscribe = [
    //     "App\Listeners\MyEventSubscriber",
    // ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {
        //
    }

    // 4-2 イベントディスカバリの設定
    // これを記述すルコとで、作成したイベントとイベントリスナーを検索して自動的に登録する様になる
    // 上で宣言した$listenち$subscribeが不要になる
    public function shouldDiscoverEvents() {
        return true;
    }
}
