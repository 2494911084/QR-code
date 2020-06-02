<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Qr;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class QrController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Qr(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->name;
            $grid->image;
            $grid->content;
            $grid->created_at;
            $grid->updated_at->sortable();
        
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
        return Show::make($id, new Qr(), function (Show $show) {
            $show->id;
            $show->name;
            $show->image;
            $show->content;
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
        return Form::make(new Qr(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('image');
            $form->text('content');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
