<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('dob');
            $table->string('employee_code')->unique();
            $table->integer('branch_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->default('0');
            $table->string('guarantor_name');
            $table->integer('guarantor_phone');
            $table->text('guarantor_address');
            $table->string('next_of_kin_name');
            $table->string('next_of_kin_phone');
            $table->string('means_of_identification');
            $table->string('employment_letter')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
