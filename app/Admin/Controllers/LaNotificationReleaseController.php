<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Modules\Notification\Models\Notification;
use Modules\Notification\Models\NotificationRelease;

class LaNotificationReleaseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Отправить уведомления';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new NotificationRelease());

        $grid->column('id', __('id'));
        $grid->column('title', __('Title'));
        $grid->column('body', __('Body'));
        $grid->column('color', __('Color'));
        $grid->column('icon', __('Icon'));
        $grid->column('notification_id', 'Уведомление')->display( fn($id) => optional(Notification::where('id', $id)->first())->name);

        $grid->column('created_at', __('Created at'))->display( fn($date) => Carbon::parse($date)->format('d-m-Y H:i:s'));
        $grid->column('updated_at', __('Updated at'))->display( fn($date) => Carbon::parse($date)->format('d-m-Y H:i:s'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new NotificationRelease());

        $form->display('id', 'ID');
        $form->text('title', 'Title');
        $form->summernote('body', __('Body'));
        $form->text('color', __('Color'));
        $form->text('icon', __('Icon'));

        $form->select('notification_id', 'Тип уведомления')->options( Notification::pluck('name', 'id'));

        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));

//        $form->saved(function (Form $form) {
//            /**
//             * @var NotificationRelease $model
//             */
//            $model = $form->model();
//
//            $notificationReleaseService = app(NotificationReleaseService::class);
//            $notificationReleaseService->release($model);
//        });

        return $form;
    }
}
