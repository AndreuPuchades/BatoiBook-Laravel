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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('module_id', 12);
            $table->string('publisher', 50);
            $table->decimal('price', 10, 0)->default(0);
            $table->smallInteger('pages')->nullable();
            $table->enum('status', ['new', 'good', 'used', 'bad'])->default('good');
            $table->string('photo', 200);
            $table->text('comments')->nullable();
            $table->date('soldDate')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('module_id')->references('code')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
