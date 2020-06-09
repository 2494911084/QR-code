<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Subject;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SubjectController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Subject(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->title;
            // $grid->optiona;
            // $grid->optionb;
            // $grid->optionc;
            // $grid->optiond;
            // $grid->optiont;
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
        return Show::make($id, new Subject(), function (Show $show) {
            $show->id;
            $show->title;
            $show->optiona;
            $show->optionb;
            $show->optionc;
            $show->optiond;
            $show->optiont;
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
        return Form::make(new Subject(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('optiona');
            $form->text('optionb');
            $form->text('optionc');
            $form->text('optiond');
            $form->text('optiont');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
