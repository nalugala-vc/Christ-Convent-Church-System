<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->foreignId('father_id')->nullable()->constrained('members');
            $table->foreignId('mother_id')->nullable()->constrained('members');
            $table->foreignId('guardian_id')->nullable()->constrained('members');
            $table->string('profile_picture')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('DOB');
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
        Schema::dropIfExists('childrens');
    }
};
