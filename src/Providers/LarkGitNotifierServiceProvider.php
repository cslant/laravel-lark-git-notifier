<?php

namespace CSlant\LaravelLarkGitNotifier\Providers;

use Illuminate\Support\ServiceProvider;

class LarkGitNotifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $routePath = __DIR__.'/../../routes/lark-bot.php';
        if (file_exists($routePath)) {
            $this->loadRoutesFrom($routePath);
        }

        $this->registerAssetPublishing();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $configPath = __DIR__.'/../../config/lark-git-notifier.php';
        $this->mergeConfigFrom($configPath, 'lark-git-notifier');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array|null
     */
    public function provides(): ?array
    {
        return ['lark-git-notifier'];
    }

    /**
     * @return void
     */
    protected function registerAssetPublishing(): void
    {
        $configPath = __DIR__.'/../../config/lark-git-notifier.php';
        $this->publishes([
            $configPath => config_path('lark-git-notifier.php'),
        ], 'config');
    }
}
