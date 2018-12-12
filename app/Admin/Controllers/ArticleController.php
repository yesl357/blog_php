<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
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
            ->header('文章列表')
            ->description('小声bb')
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
            ->header('添加博客')
            ->description('xhp')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);

        $grid->model()->orderBy('id', 'desc');
        $grid->id('Id');
        $grid->blogType()->name('所属分类');
        $grid->title('标题');
        $grid->desc('简介/描述')->limit(60);
        $states = [
            'on'  => ['value' => 1, 'text' => '置顶', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $grid->excellent('置顶')->switch($states);
        $grid->is_show('显示')->switch();
        $grid->author('作者')->editable();
        $grid->img('主图')->image('', 60, 60);
//        $grid->content('内容');
        $grid->reply('回复数')->display(function () {
            return '<a href="'.route('comment.aindex',$this->id).'" title="点击查看详情">'.$this->reply.'</a>';
        });
        $grid->looked('浏览数');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $options = DB::table('blog_types')->select('id','name as text')->get();
        $selectOption = [];
        foreach ($options as $option){
            $selectOption[$option->id] = $option->text;
        }

        $grid->filter(function($filter) use ($selectOption) {

            // 在这里添加字段过滤器
            $filter->like('title', '标题');
            $filter->whereIn();
//            $filter->in('name', '分类')->multipleSelect($selectOption);

//            $filter->whereHas('blogType', function ($query) use ($selectOption) {
//                $query->in('name', '分类')->multipleSelect($selectOption);
//            });

            $filter->where(function ($query) use ($selectOption) {

                $query->whereHas('blogType', function ($query) {
                    $query->whereIn('id', $this->input);

                });

            }, '分类')->multipleSelect($selectOption);

        });


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
        $show = new Show(Article::findOrFail($id));

        $show->id('Id');
        $show->blog_type_id('Blog type id');
        $show->title('Title');
        $show->desc('Desc');
        $show->author('Author');
        $show->img('Img');
        $show->content('Content');
        $show->reply('Reply');
        $show->looked('Looked');
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
        $form = new Form(new Article);

        $options = DB::table('blog_types')->select('id','name as text')->get();
        $selectOption = [];
        foreach ($options as $option){
            $selectOption[$option->id] = $option->text;
        }
        $form->select('blog_type_id', '分类名称')->options($selectOption)->setWidth(5)->rules('required');

        $form->text('title', '标题')->rules('required|min:2');
        $form->text('desc', '简介')->rules('required');
        $form->switch('excellent', '置顶');
        $form->switch('is_show', '是否显示');
        $form->text('author', '作者')->rules('required');
        $form->image('img', '主图')->rules('required');
        $form->editor('content', '内容')->rules('required');
//        $form->editor('content');
//        $form->number('reply', 'Reply');
//        $form->number('looked', 'Looked');

        return $form;
    }
}
