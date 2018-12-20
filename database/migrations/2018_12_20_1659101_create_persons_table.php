<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->Integer('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();

            $table->dateTimeTz('created_at')->nullable();
            $table->dateTimeTz('updated_at')->nullable();
            $table->string('slug');
            $table->softDeletes();
            $table->unique('slug');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
