<?php

namespace Mis3085\MailLog\Http\Controllers;

use Mis3085\MailLog\Models\MailLog;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class MailgunController extends BaseController
{
    /**
     * Mailgun delivered webhook
     *
     * @param Request $request
     * @return string
     */
    public function delivered(Request $request)
    {
        $this->updateMailLog($this->getMailLogId($request), MailLog::SENT);

        return '';
    }

    /**
     * Mailgun failed webhook
     *
     * @param Request $request
     * @return string
     */
    public function failed(Request $request)
    {
        $this->updateMailLog($this->getMailLogId($request), MailLog::FAILED);

        return '';
    }

    /**
     * return maillog_id
     *
     * @param Request $request
     * @return int
     */
    private function getMailLogId(Request $request)
    {
        $data = $request->input('event-data.user-variables', null);

        if (!empty($data['maillog_id'])) {
            return $data['maillog_id'];
        }
        return 0;
    }

    /**
     * update status and sent_at
     *
     * @param integer $id
     * @param string $status
     * @return void
     */
    private function updateMailLog(int $id, string $status)
    {
        if (empty($id)) {
            return false;
        }

        $mailLog = MailLog::find($id);

        if (empty($mailLog)) {
            return false;
        }

        if ($status == MailLog::SENT) {
            $mailLog->sent_at = now();
        }

        $mailLog->status  = $status;
        $mailLog->save();
    }
}
