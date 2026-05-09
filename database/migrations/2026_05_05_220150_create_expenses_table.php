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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // مثلاً: "تقضية ديال السيمانة"
            $table->decimal('amount', 10, 2); // الثمن الكلي
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // الشخص اللي خلص
            $table->string('category')->nullable(); // (خضرة، كرا، ضو...)
            $table->string('status')->default('pending')->after('amount');
            $table->boolean('is_settled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
