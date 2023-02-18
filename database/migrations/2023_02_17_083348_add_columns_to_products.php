<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('on_home_page')
                ->after('thumbnail')
                ->default(false);

            $table->integer('sorting')
                ->after('on_home_page')
                ->default(999);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['on_home_page', 'sorting']);
        });
    }
};
