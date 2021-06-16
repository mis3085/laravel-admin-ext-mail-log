<?php

namespace Mis3085\MailLog\Listeners;

use Mis3085\MailLog\Models\MailLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $identity = $event->message->getHeaders()->get('X-Mailgun-Variables')->getValue();
        $identity = json_decode($identity);

        if (empty($identity->maillog_id)) {
            return ;
        }

        // mark as: smtp ?? sent, other ?? queued
        $mailLog = MailLog::find($identity->maillog_id);
        if (!$mailLog) {
            return ;
        }

        $driver = config('mail.driver', config('mail.default'));
        if (in_array($driver, ['smtp', 'log', 'array'])) {
            $mailLog->sent_at = now();
            $mailLog->status = MailLog::SENT;
        } else {
            $mailLog->status = MailLog::QUEUED;
        }

        $mailLog->save();
    }
}
