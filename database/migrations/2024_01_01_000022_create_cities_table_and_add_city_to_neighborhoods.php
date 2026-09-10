<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable()->after('name');
        });

        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });

        Schema::dropIfExists('cities');
    }
};
