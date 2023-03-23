<?php

namespace App\Admin\Controllers;

use App\Enums\ActiveStatusEnum;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Modules\Game\Entities\Game;

class LaGameController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Новеллы';

    /**
     * Make a grid builder.
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Game());

        $grid->column('id', __('Id'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('name', __('Name'));
        $grid->column('short', __('Short'));
        $grid->column('width', __('Width'));
        $grid->column('height', __('Height'));
        $grid->column('is_active', 'Статус')
            ->using(ActiveStatusEnum::toSelect())
            ->label(ActiveStatusEnum::toLabels());
        $grid->column('image', __('Image'))->display(function () {
            return $this->image;
        })->image('', 100, 100);
        $grid->column('restriction', __('Restriction'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Game::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('description', __('Description'));
        $show->field('short_description', __('Short description'));
        $show->field('name', __('Name'));
        $show->field('short', __('Short'));
        $show->field('width', __('Width'));
        $show->field('height', __('Height'));
        $show->field('is_active', __('Is active'));
        $show->field('image', __('Image'))->image();
        $show->field('image_id', __('Image id'));
        $show->field('restriction', __('Restriction'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Game());

        $form->number('parent_id', __('Parent id'));
        $form->summernote('description', __('Description'));
        $form->summernote('short_description', __('Short description'));
        $form->text('name', __('Name'));
        $form->text('short', __('Short'));
        $form->text('width', __('Width'));
        $form->text('height', __('Height'));
        $form->image('imageFile.url');
        $form->select('is_active', 'Активность')->options(ActiveStatusEnum::toSelect())
            ->default(ActiveStatusEnum::Active->value);
        $form->number('restriction', __('Restriction'));

        return $form;
    }
}
