<?php

namespace Mis3085\MailLog\Http\Controllers;

use Mis3085\MailLog\Models\MailLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class MailLogController extends AdminController
{
    protected function title()
    {
        return __('mail-log::mail-log.title');
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $this->detail($id);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $options = [
            'status-colors' => __('mail-log::mail-log.status-colors'),
        ];

        $grid = new Grid(new MailLog);
        $grid->model()->orderBy('id', 'desc');

        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->disableRowSelector();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1/2, function ($filter) {
                $filter->where(function ($query) {
                    $query->where('recipient', 'like', "{$this->input}%");
                }, trans('mail-log::mail-log.attrs.recipient'));
            });
        });

        $grid->column('id', 'ID');
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('sent_at', __('mail-log::mail-log.attrs.sent_at'));
        $grid->column('status', __('mail-log::mail-log.attrs.status'))->label($options['status-colors']);
        $grid->column('recipient', __('mail-log::mail-log.attrs.recipient'))->style('width:20%;');

        $grid->column('subject', __('mail-log::mail-log.attrs.subject'))
            ->link(function ($value) {
                return route('admin.mail-logs.show', ['mail_log' => $this->id]);
            })
            ->style('width:50%;');

        return $grid;
    }

    protected function detail($id)
    {
        $log = MailLog::findOrFail($id);

        return $log->raw;
    }
}
