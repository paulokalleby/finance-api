<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moviments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index()->cascadeOnDelete();
            $table->uuid('wallet_id')->index()->cascadeOnDelete();
            $table->uuid('category_id')->index()->cascadeOnDelete();
            $table->string('description');
            $table->string('type')->default('output');
            $table->double('value', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moviments');
    }
};
