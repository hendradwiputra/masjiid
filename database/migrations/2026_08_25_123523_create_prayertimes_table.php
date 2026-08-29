<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prayertimes', function (Blueprint $table) {
            $table->id();
            // General
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('timezone')->default('7');            
            $table->string('dst')->default('0');

            // Display Settings - Stored as JSON (Clean & Flexible)
            $table->json('prayer_names')->nullable();
            $table->json('prayer_correction')->nullable();

            // Calculation Settings
            $table->string('calculation_method')->default('Kemenag');
            $table->string('time_format')->default('24h');
            $table->integer('hijri_adjustment')->default(0);

            // Alert
            $table->string('adhan_title')->nullable()->default('Waktunya Adzan');
            $table->integer('adhan_duration')->default(10);
            $table->json('iqomah_duration')->nullable();
            $table->string('iqomah_title')->nullable()->default('Menjelang Iqomah');
            $table->string('prayers_title')->nullable()->default('Telah masuk waktu sholat');
            $table->integer('prayers_duration')->default(10);
            $table->integer('jumuah_duration')->default(30);
            $table->string('sunrise_title')->nullable()->default('Waktu terlarang sholat');
            $table->integer('sunrise_duration')->default(15);
            
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayertimes');
    }
};
