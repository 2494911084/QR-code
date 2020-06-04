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
            // dd(empty(\App\File::select(['id', 'file_name'])->get()));
            $grid->id->sortable();
            $grid->name;

            $grid->website->qrcode(function () {
                return config('app.url') . '/weixin/qr_files?qr_id/' . $this->id ;
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
            $form->text('name')->rules('required');
            // $form->text('image')->rules('required');
            // $form->listbox('content')->options($this->get_files())->rules('required');
            $form->checkbox('content')
                ->options($this->get_files())
                ->saving(function ($value) {
                    // 转化成json字符串保存到数据库
                    return json_encode($value);
                });
            $form->display('created_at');
            $form->display('updated_at');
            // 去掉跳转详情页按钮
            $form->disableViewButton();
        });
    }

    // 获取所有交底文件，并转为需要的格式
    public function get_files()
    {
        $file = \App\File::select(['id', 'file_name'])->get();
        $files = [];
        if (!empty($file)) {
            foreach ($file as $key => $value) {
                $files[$value['id']] = $value['file_name'];
            }
        }
        return $files;
    }
}
