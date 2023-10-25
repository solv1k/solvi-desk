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
        Schema::create('advert_stats', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('advert_id')->constrained()->onDelete('CASCADE');
            $table->date('date')->index();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('phone_views')->default(0);
            $table->timestamps();

            $table->unique(['advert_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_stats');
    }
};
