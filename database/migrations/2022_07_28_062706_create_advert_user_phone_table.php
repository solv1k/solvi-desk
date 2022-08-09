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
        Schema::create('advert_user_phone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advert_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('user_phone_id')->constrained()->onDelete('CASCADE');
            $table->boolean('selected')->default(0);
            $table->string('contact_name', 100)->nullable();
            $table->timestamps();
            // у объявления может быть выбран только один номер телефона
            $table->unique(['advert_id', 'user_phone_id', 'selected']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_user_phone');
    }
};
