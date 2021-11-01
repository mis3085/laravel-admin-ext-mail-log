<?php

namespace Mis3085\MailLog;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Mis3085\MailLog\Listeners\LogSendingMessage;
use Mis3085\MailLog\Listeners\LogSentMessage;

class MailLogServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(MailLog $extension)
    {
        if (!MailLog::boot()) {
            return;
        }

        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'mail-log');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mail-log');

        $this->commands($extension->commands);

        $this->app->booted(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        $this->registerListeners();
    }

    /**
     * register listeners.
     *
     * @return void
     */
    private function registerListeners()
    {
        Event::listen(
            \Illuminate\Mail\Events\MessageSending::class,
            LogSendingMessage::class,
        );

        Event::listen(
            \Illuminate\Mail\Events\MessageSent::class,
            LogSentMessage::class,
        );
    }
}
