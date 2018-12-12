<?php

use Illuminate\Database\Seeder;
use App\Models\BlogType;

class BlogTypesTableSeeder extends Seeder
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

//        $shop_ids = \App\Models\BlogType::all()->pluck('id')->toArray();
        $rooms = factory(BlogType::class)
            ->times(5)
            ->make();

        BlogType::insert($rooms->toArray());
    }
}
