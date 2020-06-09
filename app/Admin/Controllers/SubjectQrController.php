<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SubjectQr;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SubjectQrController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SubjectQr(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->subject_qr_name;
            $grid->website->qrcode(function () {
                return config('app.url') . '/weixin/subject?id/' . $this->id ;
            }, 200, 200);
            $grid->created_at;
            $grid->updated_at->sortable();
            // 去掉详情按钮
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
        return Show::make($id, new SubjectQr(), function (Show $show) {
            $show->id;
            $show->subject_qr_name;
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
        return Form::make(new SubjectQr(), function (Form $form) {
            $form->display('id');
            $form->text('subject_qr_name');
            $form->checkbox('content')
                ->options($this->get_subjects())
                ->saving(function ($value) {
                    // 转化成json字符串保存到数据库
                    return json_encode($value);
                });
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
    // 获取题库，并转为需要的格式
    public function get_subjects()
    {
        $subject = \App\Subject::select(['id', 'title'])->get();
        $subjects = [];
        if (!empty($subject)) {
            foreach ($subject as $key => $value) {
                $subjects[$value['id']] = $value['title'];
            }
        }
        return $subjects;
    }
}
