<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->name;
            $grid->r_name;
            $grid->avatar()->image();
            $grid->weixin_openid;
            $grid->weixin_session_key;
            $grid->phone;
            $grid->created_at;
            $grid->updated_at->sortable();

            // 禁用创建按钮
            $grid->disableCreateButton();
            // 显示创建按钮
            // $grid->showCreateButton();

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
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            $show->name;
            $show->r_name;
            $show->avatar;
            $show->weixin_openid;
            $show->weixin_session_key;
            $show->phone;
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
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('r_name');
            $form->image('avatar');
            $form->text('weixin_openid');
            $form->text('weixin_session_key');
            $form->text('phone');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
