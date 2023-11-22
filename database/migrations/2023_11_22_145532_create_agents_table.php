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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('agent_id')->unique();
            $table->string('country_code', 5);
            $table->string('mobile');
            $table->string('country');
            $table->string('city');
            $table->string('area');
            $table->string('address');
            $table->foreignId('currency_id')->constrained();
            $table->string('document_type')->comment('1 = NID, 2 = Passport ,3 = Driving ,4 = Birth Certificate');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
