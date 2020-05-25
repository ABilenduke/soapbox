<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use Throwable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        Schema::enableForeignKeyConstraints();
        $this->disableExceptionHandling();
    }

    protected function signInAdmin(User $admin = null)
    {
        $admin = $admin ?: factory(User::class)->create(['is_admin' => true]);
        Passport::actingAs(
            $admin
        );
        return $this;
    }

    protected function signInUser(User $user = null)
    {
        $user = $user ?: factory(User::class)->create();
        Passport::actingAs(
            $user
        );
        return $this;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler
        {
            public function __construct()
            {
            }

            public function report(Throwable $exception)
            {
            }

            public function render($request, Throwable $exception)
            {
                throw $exception;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
}
