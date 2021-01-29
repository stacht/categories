<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorizableTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('stacht-categories.tables.categorizables'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->morphs('categorizable');
            $table->timestamps();

            // Indexes
            $table->unique(['category_id', 'categorizable_id', 'categorizable_type'], 'categorizables_ids_type_unique');
            $table->foreign('category_id')->references('id')->on(config('stacht-categories.tables.categories'))->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('stacht-categories.tables.categorizables'));
    }
}
