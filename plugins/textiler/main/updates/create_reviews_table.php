<?php namespace Textiler\Main\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateReviewsTable Migration
 */
class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('textiler_main_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('rating')->default(5);
            $table->boolean('status')->default(false);
            $table->string('name')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('textiler_main_reviews');
    }
}
