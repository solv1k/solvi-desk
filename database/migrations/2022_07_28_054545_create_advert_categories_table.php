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
        Schema::create('advertCategories', static function (Blueprint $table): void {
            $table->id();
            $table->nestedSet();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('icon_symbol', 3)->default('?');
            $table->string('icon_color', 7)->default('#dddddd');
            $table->tinyInteger('order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertCategories');
    }
};
