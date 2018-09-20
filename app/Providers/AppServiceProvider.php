<?php

namespace App\Providers;

use App\Http\ViewComposers\AdminArticleManageComposer;
use App\Http\ViewComposers\BlogSidebarComposer;
use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Paginator::defaultView('common.paginator');

        \View::composer('blog.sidebar', BlogSidebarComposer::class);
        \View::composer('admin.article.manage', AdminArticleManageComposer::class);

        // Auto login on local environment
        if (config('app.env') == 'local') {
            try {
                if (! \Auth::check()) {
                    $user = User::whereEmail(config('me.email'))->first();
                    if ($user) {
                        \Auth::login($user);
                    }
                }
            } catch (\Exception $e) {
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
