<?php namespace Textiler\Main\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateSubscribersTable Migration
 */
class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('textiler_main_subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('apartment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('textiler_main_subscribers');
    }
}
