<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //改名称
        $this->gairegister();
    }

    /*
    * 注册服务
    */
    public function gairegister()
    {
        //调用下面的方法，改名称，例：将app/Service文件夹里的search类在此改为EsSearchService，之后直接use EsSearchService即可
        // 下面相当于：$this->app->bind('App\Service\EsSearchService','App\Service\Search');
        $this->registerBindings([
            'EsSearchService'  => 'Search',
        ], 'App\Service\\');
    }

    /*
    * 相当于名称重命名，创建快捷方式
    */
    protected function registerBindings(array $bindings, $prefix = '')
    {
        foreach ($bindings as $name => $implement)
        {
            $this->app->bind($prefix . $name, $prefix . $implement);//智能的创建快捷方式
        }
    }
}
