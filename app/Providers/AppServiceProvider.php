<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Student\StudentRepositoryInterface::class,
            \App\Repositories\Student\StudentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Faculty\FacultyRepositoryInterface::class,
            \App\Repositories\Faculty\FacultyRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Subject\SubjectRepositoryInterface::class,
            \App\Repositories\Subject\SubjectRepository::class
        );

        $this->app->singleton(
            \App\Repositories\SubjectScore\SubjectScoreRepositoryInterface::class,
            \App\Repositories\SubjectScore\SubjectScoreRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
