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
        Schema::create('advert_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advert_id')->constrained()->onDelete('CASCADE');
            $table->string('image_path', 100)->unique();
            $table->unsignedTinyInteger('order')->default(0);
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
        Schema::dropIfExists('advert_images');
    }
};
