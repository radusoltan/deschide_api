<?php

use App\Models\Image;
use App\Models\Thumbnail;
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
        Schema::create('image_thumbnails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Image::class);
            $table->foreignIdFor(Thumbnail::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_thumbnails');
    }
};
