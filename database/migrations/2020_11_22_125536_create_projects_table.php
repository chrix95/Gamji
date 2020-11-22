<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('project_code');
            $table->text('project_name');
            $table->string('start_date');
            $table->string('expected_end_date');
            $table->string('client_name');
            $table->string('client_phone')->nullable();
            $table->string('estimated_cost')->nullable();
            $table->enum('status', ['created', 'ongoing', 'paused', 'completed', 'closed']);
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
        Schema::dropIfExists('projects');
    }
}
