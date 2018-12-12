<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CommentController extends Controller
{
    use HasResourceActions;


    /**
     * 文章的对应评论
     * @param Content $content
     * @param Article $article
     * @return Content
     */
    public function aindex(Content $content, Article $article)
    {
        return $content
            ->header($article->title)
            ->description('对应评论')
            ->body($this->grid($article));
    }

    public function today(Content $content)
    {
        return $content
            ->header('今日评论')
            ->body($this->grid2());
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
 * Make a grid builder.
 *
 * @return Grid
 */
    protected function grid($article)
    {
        $grid = new Grid(new Comment);

        $grid->model()->where('article_id',$article->id)->orderBy('id','desc');
        $grid->id('Id');
        $grid->user()->name('用户名');
        $grid->article()->title('标题');
        $grid->contents('评论内容');
        $grid->agrees('点赞数');
        $grid->refuses('反对数');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            // append一个操作
//            $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
//            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid2()
    {
        $grid = new Grid(new Comment);

        $grid->model()->where('created_at', '>=', date('Y-m-d'));
        $grid->id('Id');
        $grid->user()->name('用户名');
        $grid->article()->title('标题');
        $grid->contents('评论内容');
        $grid->agrees('点赞数');
        $grid->refuses('反对数');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            // append一个操作
//            $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
//            $actions->disableView();
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
        $show = new Show(Comment::findOrFail($id));

        $show->id('Id');
        $show->user_id('User id');
        $show->article_id('Article id');
        $show->contents('Contents');
        $show->agrees('Agrees');
        $show->refuses('Refuses');
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
        $form = new Form(new Comment);

        $form->number('user_id', 'User id');
        $form->number('article_id', 'Article id');
        $form->textarea('contents', 'Contents');
        $form->number('agrees', 'Agrees');
        $form->number('refuses', 'Refuses');

        return $form;
    }
}
