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
        Schema::table('images', function (Blueprint $table) {
            // Add new columns
            $table->enum('type', ['image', 'video'])->default('image')->after('image_name');
            $table->string('mime_type')->nullable()->after('type');
            $table->integer('file_size')->nullable()->after('mime_type');
            
            // Rename existing column (optional)
            $table->renameColumn('image_name', 'file_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            // Reverse the changes
            $table->renameColumn('file_name', 'image_name');
            $table->dropColumn(['type', 'mime_type', 'file_size']);
        });
    }
};
