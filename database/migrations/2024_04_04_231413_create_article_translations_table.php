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
        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')
                ->references('id')
                ->on('articles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('lead')->nullable(true);
            $table->text('body')->nullable(true);
            $table->unique(['locale','slug']);
            $table->enum('status',['N','S','P'])->default('N');
            $table->boolean('is_flash')->default(false);
            $table->boolean('is_alert')->default(false);
            $table->boolean('is_breaking')->default(false);
            $table->timestamp('publish_at')->nullable(true);
            $table->timestamp('published_at')->nullable(true);
            $table->boolean('is_locked')->default(false);
            $table->integer('locked_by_user')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_translations');
    }
};
