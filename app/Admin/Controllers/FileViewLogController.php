<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FileViewLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
// use App\FileViewLog;

class FileViewLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FileViewLog(['file', 'user']), function (Grid $grid) {
            $grid->export();
            $grid->id->sortable();
            // $grid->file_id;
            $grid->column('file.file_name');
            // $grid->user_id;
            $grid->column('user.name');
            $grid->qm_img()->image();
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
        return Show::make($id, new FileViewLog(), function (Show $show) {
            $show->id;
            $show->file_id;
            $show->user_id;
            $show->view_often;
            $show->view_time;
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
        return Form::make(new FileViewLog(), function (Form $form) {
            $form->display('id');
            $form->text('file_id');
            $form->text('user_id');
            $form->text('view_often');
            $form->text('view_time');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
