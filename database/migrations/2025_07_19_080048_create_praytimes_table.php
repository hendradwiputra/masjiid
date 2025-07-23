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
        Schema::create('praytimes', function (Blueprint $table) {
            $table->id();
            $table->string('time_format', length: 3);
            $table->string('prayer_calc_method', length: 10);
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('timezone');
            $table->integer('dst');
            $table->integer('hijri_correction');
            $table->string('prayer1_alias', length:8);
            $table->string('prayer2_alias', length:8);
            $table->string('prayer3_alias', length:8);
            $table->string('prayer4_alias', length:8);
            $table->string('prayer5_alias', length:8);
            $table->string('prayer6_alias', length:8);
            $table->integer('sunrise_lock_duration');
            $table->integer('prayer_lock_duration');
            $table->integer('jumuah_lock_duration');
            $table->string('sunrise_caption');
            $table->string('prayer_caption');
            $table->string('adhan_caption');
            $table->string('iqomah_caption');
            $table->integer('adhan_duration');
            $table->integer('prayer1_iqomah_duration');
            $table->integer('prayer3_iqomah_duration');
            $table->integer('prayer4_iqomah_duration');
            $table->integer('prayer5_iqomah_duration');
            $table->integer('prayer6_iqomah_duration');
            $table->integer('prayer1_correction');
            $table->integer('prayer2_correction');
            $table->integer('prayer3_correction');
            $table->integer('prayer4_correction');
            $table->integer('prayer5_correction');
            $table->integer('prayer6_correction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praytimes');
    }
};
