<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('statch-categories.tables.categories'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->nestedSet();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('statch-categories.tables.categories'));
    }
}
