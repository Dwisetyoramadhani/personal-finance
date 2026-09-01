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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('account_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('type', [
                'income',
                'expense'
            ]);

            $table->decimal('amount', 15, 2);

            $table->string('merchant')->nullable();

            $table->text('description')->nullable();

            $table->string('source')->nullable();

            $table->string('external_id')->nullable();

            $table->timestamp('transaction_date');

            $table->json('raw_data')->nullable();

            $table->timestamps();

            $table->unique([
                'user_id',
                'external_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
