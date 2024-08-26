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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            // create the user_id column that be the foreign key id in the users DB Table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // create the category_id column that be the foreign key id in the categories DB Table
            $table->foreignId('category_id')->constrained('categories');
            $table->boolean('pending');
            $table->string('title');
            $table->date('date')->nullable();
            $table->date('date_limit')->nullable();
            $table->decimal('rating', total: 3, places: 2)->nullable();
            $table->string('url')->nullable();
            $table->text('info')->nullable();
            $table->text('comment')->nullable();
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
