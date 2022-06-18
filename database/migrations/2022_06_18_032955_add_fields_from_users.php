<?php

use App\Models\Profile;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo', 255)->nullable();
            $table->unsignedBigInteger('profile_id')->nullable()->default(Profile::USER);
            $table->date('birthday')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('profile_id');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
        });
    }
};
