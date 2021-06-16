<?php

namespace Mis3085\MailLog;

use Encore\Admin\Extension;
use Mis3085\MailLog\Console\MailLogPruneCommand;

class MailLog extends Extension
{
    public $name = 'laravel-admin-ext-mail-log';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Mail Logs',
        'path'  => 'mail-logs',
        'icon'  => 'fa-send',
    ];

    public $commands = [
        MailLogPruneCommand::class,
    ];
}
