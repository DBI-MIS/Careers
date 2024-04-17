<?php

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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignIdFor(Post::class,'post_title');
            $table->date('date_response');
            $table->string('contact')->nullable();
            $table->string('email_address')->nullable();
            $table->longText('current_address')->charset('binary');
            $table->string('attachment')->nullable();
            $table->boolean('status')->default(true);
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
