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
        Schema::create('form_new_project', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->string('collaborator');
            $table->string('url');
            $table->string('accesskey');
            $table->string('secretaccesskey');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_new_project');
    }
};
