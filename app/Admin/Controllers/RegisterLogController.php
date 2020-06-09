<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RegisterLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class RegisterLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RegisterLog(['user', 'register']), function (Grid $grid) {

            $grid->id->sortable();
            $grid->column('register.name');
            $grid->column('user.r_name');
            $grid->created_at;
            $grid->updated_at->sortable();

            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableQuickEditButton();
            $grid->disableViewButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new RegisterLog(), function (Show $show) {
            $show->id;
            $show->register_id;
            $show->user_id;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new RegisterLog(), function (Form $form) {
            $form->display('id');
            $form->text('register_id');
            $form->text('user_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
