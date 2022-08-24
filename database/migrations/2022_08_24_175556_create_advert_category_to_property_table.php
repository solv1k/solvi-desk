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
        Schema::create('advert_category_to_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advert_category_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('advert_category_property_id')->constrained()->onDelete('CASCADE');
            $table->boolean('required')->default(false);
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
        Schema::dropIfExists('advert_category_to_property');
    }
};
