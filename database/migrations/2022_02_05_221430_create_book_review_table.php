<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_review', function (Blueprint $table) {
			$table->tinyIncrements('id');
			$table->string('reviewer');
			$table->float('grade');
			$table->tinyInteger('book_id');
			$table->foreign('book_id')
				->references('id')
				->on('book');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_review');
    }
}
