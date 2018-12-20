<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('person_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('job_id');

            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('cascade');
            $table
                ->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_jobs');
    }
}
