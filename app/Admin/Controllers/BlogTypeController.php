<?php

namespace App\Admin\Controllers;

use App\Models\BlogType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BlogTypeController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('博客文章--分类列表')
            ->description('一些描述')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('博客分类添加')
            ->description('小声bb')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogType);

        $grid->id('Id');
        $grid->name('分类名称');
        $grid->sort('排序');
        $grid->desc('描述')->limit(30);
        $grid->img_path('图片地址')->image('', 60, 60);
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BlogType::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->sort('Sort');
        $show->img_path('Img path');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BlogType);

        $form->text('name', '名称')->placeholder('请输出名称')->help('2到10个字符')->rules('required|min:2|max:10')->setWidth(3, 2);
        $form->number('sort', 'Sort')->setWidth(3, 2);
        $form->text('desc', '描述')->placeholder('请输入描述')->rules('required');
        $form->image('img_path', '主图')->removable()->setWidth(8);

        return $form;
    }
}
