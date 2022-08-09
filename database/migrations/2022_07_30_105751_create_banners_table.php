<?php

use App\Enums\BannerStatusEnum;
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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('banner_position_id')->constrained();
            $table->string('title', 100);
            $table->string('url', 100);
            $table->string('image_path', 100)->unique();
            $table->tinyInteger('status')->default(BannerStatusEnum::CREATED->value);
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
        Schema::dropIfExists('banners');
    }
};
