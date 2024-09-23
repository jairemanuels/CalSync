<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users');
            $table->string('domain');
            $table->string('language');
            $table->string('country');
            $table->string('timezone');
            $table->enum('clock', ['12', '24'])->default('24');
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
