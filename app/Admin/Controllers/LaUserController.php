<?php

namespace App\Admin\Controllers;

use App\Enums\ActiveStatusEnum;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Modules\User\Entities\User;

class LaUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пользователи';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new User());

        $grid->column('id', __('id'));
        $grid->column('name', __('Логин'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Телефон'));
        $grid->column('email_verified_at', __('Подтвержден'))->display( fn($date) => $date ? Carbon::parse($date)->format('d-m-Y H:i:s') : 'Не подтвержден');
        $grid->column('is_active', 'Статус')->using(ActiveStatusEnum::toSelect())->label(ActiveStatusEnum::toLabels());
        $grid->column('image', __('Image'))->display( function () {
            return $this->image;
        })->image('', 100, 100);

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
        $form = new Form(new User());

        $form->display('id', 'ID');
        $form->text('name', 'Имя');
        $form->text('email', 'Email');
        $form->text('phone', 'Телефон');
        $form->text('password', 'Пароль');

        $form->datetime('email_verified_at', 'Дата подтверждения');

        $form->select('is_active', 'Активность')->options(ActiveStatusEnum::toSelect())
            ->default(ActiveStatusEnum::Active->value);

        $form->image('imageFile.url');

        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));

        $form->saving(static function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = \Hash::make($form->password);
            }

        });

        return $form;
    }
}
