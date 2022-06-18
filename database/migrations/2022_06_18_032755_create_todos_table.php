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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 140);
            $table->text('description')->nullable();
            $table->string('file', 255)->nullable();
            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('file_extension', 20)->nullable();
            $table->date('remember_at')->nullable();
            $table->bigInteger('cost')->nullable(); // centavos
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
        Schema::dropIfExists('todos');
    }
};
