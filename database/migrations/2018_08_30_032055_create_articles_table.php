<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_type_id');
            $table->string('title', 255);
            $table->text('desc');
            $table->string('author', 255);
            $table->string('img', 255);
            $table->longText('content')->default(0);
            $table->integer('reply')->default(0);
            $table->integer('looked');
            $table->boolean('excellent');
            $table->boolean('is_show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
