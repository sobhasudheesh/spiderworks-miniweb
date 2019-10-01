<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 255)->unique();
            $table->string('name', 255);
            $table->string('page_title', 255)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('types_id')->nullable();
            $table->bigInteger('banner_image_id')->nullable();
            $table->bigInteger('primary_image_id')->nullable();
            $table->string('browser_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('top_description', 1000)->nullable();
            $table->string('bottom_description', 1000)->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
