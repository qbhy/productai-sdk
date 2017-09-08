<?php

namespace Qbhy\ProductAI;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;



class ProductAIServiceProvider extends ServiceProvider
{
    /**
     * 延迟启动
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->setupConfig();

    }

    /**
     * 设置配置
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/config/productai.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('productai.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('productai');
        }

        $this->mergeConfigFrom($source, 'productai');
    }


    public function register()
    {
        $this->app->bind(ProductAI::class, function ($app) {
            $config = config('productai');
            return new ProductAI($config);
        });

        $this->app->alias(ProductAI::class, 'productai');
    }
}

