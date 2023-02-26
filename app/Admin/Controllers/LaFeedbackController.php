<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Modules\Feedback\Entities\Feedback;
use Modules\Feedback\Enums\FeedbackRelationEnum;
use Modules\User\Entities\User;

class LaFeedbackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Обратная связь';

    /**
     * Make a grid builder.
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Feedback());

        $grid->column('id', __('id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('text', __('Text'))->limit();
        $grid->column('user_id', 'Пользователь')->display(fn ($user_id) => optional(User::where('id', $user_id)->first())->name);
        $grid->column('relation', 'Relation')
            ->using(FeedbackRelationEnum::toSelect())
            ->label(FeedbackRelationEnum::toLabels());

        $grid->column('created_at', __('Created at'))->display(fn ($date) => Carbon::parse($date)->format('d-m-Y H:i:s'));
        $grid->column('updated_at', __('Updated at'))->display(fn ($date) => Carbon::parse($date)->format('d-m-Y H:i:s'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     * @return Show
     */
    protected function detail($id)
    {
    }

    /**
     * Make a form builder.
     */
    protected function form(): Form
    {
        $form = new Form(new Feedback());

        $form->display('id', 'ID');
        $form->text('name', 'Имя');
        $form->text('email', 'Email');
        $form->select('relation', 'Relation')->options(FeedbackRelationEnum::toSelect())->default(FeedbackRelationEnum::Site->value);
        $form->summernote('text', __('Text'));

        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));

        $form->display('user.id');
        $form->display('user.name');
        $form->display('user.email');

        return $form;
    }
}
