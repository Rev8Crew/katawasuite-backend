<?php

namespace App\Admin\Controllers;

use App\Enums\ActiveStatusEnum;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Modules\Achievement\Enums\RewardTypeEnum;
use Modules\Achievement\Models\Achievement;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

class LaAchievementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Достижения';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Achievement());

        $grid->model()->orderBy('short');

        $grid->column('id', __('id'));
        $grid->column('name', __('Name'));
        $grid->column('short', __('Short'));
        $grid->column('description', __('Description'));
        $grid->column('game_id', 'Новелла')->display( fn($game_id) => optional(Game::where('id', $game_id)->first())->name);
        $grid->column('is_active', 'Статус')->using(ActiveStatusEnum::toSelect())->label(ActiveStatusEnum::toLabels());
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
        $form = new Form(new Achievement());

        $form->display('id', 'ID');
        $form->text('name', 'Название');
        $form->text('short', 'Аббреввиатура на англ');
        $form->summernote('description', __('Description'));
        $form->select('is_active', 'Активность')->options(ActiveStatusEnum::toSelect())
            ->default(ActiveStatusEnum::Active->value);

        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));

        $form->select('game_id', 'Новелла')->options( Game::orderBy('id')->pluck('name', 'id') );
        $form->multipleSelect('users', 'Пользователи')->options(User::all()->pluck('name','id'))->help('Пользователи которые уже получили достижение');

        $form->hasMany('rewards', 'Награды', function (Form\NestedForm $form) {
            $form->select('type', 'Тип')->options(RewardTypeEnum::labels())->default(RewardTypeEnum::Text->value);
            $form->text('value', 'Значение');
            $form->select('is_active', 'Активность')->options(ActiveStatusEnum::toSelect())
                ->default(ActiveStatusEnum::Active->value);
        });

        return $form;
    }
}
