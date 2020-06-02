<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\File;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class FileController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new File(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->file_name;
            $grid->file;
            $grid->view_count;
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
        return Show::make($id, new File(), function (Show $show) {
            $show->id;
            $show->file_name;
            $show->file;
            $show->view_count;
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
        return Form::make(new File(), function (Form $form) {
            $form->display('id');
            $form->text('file_name');
            $form->text('file');
            $form->text('view_count');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
