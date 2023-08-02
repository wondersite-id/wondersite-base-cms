<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('parent_id')->nullable();
            $table->string('name');
            $table->unsignedInteger('sequence_number');
            $table->string('type')->default('header');
            $table->string('url');
            $table->boolean('is_open_in_new_tab')->default(false);
            $table->timestamps();
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('menus');
    }
};