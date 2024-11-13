<?php

use App\Models\Hashtag;
use App\Models\Post;
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
        Schema::create('hashtag_post', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hashtag::class, 'hashtag_id')
                ->index()
                ->constrained('hashtags')
                ->onDelete('cascade');
            $table->foreignIdFor(Post::class, 'post_id')
                ->index()
                ->constrained('posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hashtag_post');
    }
};
