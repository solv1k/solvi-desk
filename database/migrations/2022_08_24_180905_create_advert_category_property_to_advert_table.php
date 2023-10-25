<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advert_category_property_to_advert', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('advert_id')->constrained()->onDelete('CASCADE');
            $table->unsignedBigInteger('advert_category_property_id');
            $table->string('value', 50);
            $table->timestamps();

            $table->foreign('advert_category_property_id', 'acp_id_foreign')->references('id')->on('advert_category_properties')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_category_property_to_advert');
    }
};
