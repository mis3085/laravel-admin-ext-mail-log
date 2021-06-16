<?php

namespace Mis3085\MailLog\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    use DefaultDatetimeFormat;

    const STARTING = 'starting';
    const QUEUED   = 'queued';
    const SENT     = 'sent';
    const FAILED   = 'failed';

    protected $fillable = [
        'sent_at',
        'status',
        'log',
        'recipient',
        'subject',
        'raw',
    ];
}
