<?php

namespace Mis3085\MailLog\Listeners;

use Mis3085\MailLog\Models\MailLog;

class LogSendingMessage
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
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $log = [
            'status'    => MailLog::STARTING,
            'recipient' => implode(', ', array_keys($event->message->getTo())),
            'subject'   => $event->message->getSubject(),
            'raw'       => $event->message->getBody(),
        ];

        $maillog = MailLog::create($log);

        // add identifier: X-Mailgun-Variables
        $event->message->getHeaders()->addTextHeader('X-Mailgun-Variables', json_encode([
            'maillog_id' => $maillog->id,
        ]));
    }
}
