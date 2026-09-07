<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->unique()->nullable()->after('email');
            $table->date('birthdate')->nullable()->after('phone');
            $table->string('profession', 100)->nullable()->after('birthdate');
            $table->unsignedBigInteger('neighborhood_id')->nullable()->after('profession');
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
            $table->boolean('is_admin')->default(false)->after('phone_verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'birthdate', 'profession', 'neighborhood_id', 'phone_verified_at', 'is_admin']);
        });
    }
};
