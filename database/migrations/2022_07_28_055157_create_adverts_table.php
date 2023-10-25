<?php

declare(strict_types=1);

use App\Enums\AdvertStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adverts', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('advert_category_id')->constrained();
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->string('main_image_path', 255)->nullable();
            $table->unsignedInteger('price');
            $table->tinyInteger('status')->default(AdvertStatusEnum::CREATED->value);
            $table->softDeletes();
            $table->timestamps();

            $table->index('advert_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
