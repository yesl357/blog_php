<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $type_ids = \App\Models\BlogType::all()->pluck('id')->toArray();
        $articles = factory(Article::class)
            ->times(20)
            ->make()
            ->each(function($article)
            use ($type_ids, $faker){
                $article->blog_type_id = $faker->randomElement($type_ids);
            });

        Article::insert($articles->toArray());
    }
}
