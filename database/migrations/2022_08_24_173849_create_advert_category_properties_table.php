<?php

declare(strict_types=1);

use App\Enums\AdvertCategoryPropertyTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advert_category_properties', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('advert_category_id')->constrained()->onDelete('CASCADE');
            $table->string('title', 100);
            $table->string('slug', 50);
            $table->enum('type', array_column(AdvertCategoryPropertyTypeEnum::cases(), 'value'))->default(AdvertCategoryPropertyTypeEnum::STRING->value);
            $table->json('additional_data')->nullable();
            $table->string('validation_rules', 100)->nullable();
            $table->string('prefix', 30)->nullable();
            $table->string('suffix', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_category_properties');
    }
};
