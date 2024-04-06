<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // protected $connection = 'pgsql';
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(User::class);
            $table->date('date_posted');
            $table->longText('post_description')->charset('binary');
            $table->longText('post_responsibility')->charset('binary');
            $table->longText('post_qualification')->charset('binary');
            $table->string('slug')->unique();
            $table->string('job_location');
            $table->string('job_level');
            $table->string('job_type');
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
