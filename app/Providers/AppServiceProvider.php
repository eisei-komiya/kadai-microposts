<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Fakerインスタンスをシングルトンとして登録
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('ja_JP');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \URL::forceScheme('https'); // リンクをHTTPSにする設定に修正
    }
}
