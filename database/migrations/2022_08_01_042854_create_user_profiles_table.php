<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');$table->string("first_name", 50)->nullable();
            $table->string("last_name", 50)->nullable();
            $table->string("photo", 150)->nullable();
            $table->text("address")->nullable();
            $table->timestamps();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
