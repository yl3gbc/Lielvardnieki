<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('joomla_menus', function (Blueprint $table) {
            $table->id(); $table->unsignedBigInteger('joomla_id')->nullable()->unique();
            $table->string('menutype', 24); $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('level'); $table->unsignedInteger('lft');
            $table->unsignedInteger('rgt')->nullable();
            $table->string('title'); $table->text('link')->nullable();
            $table->smallInteger('published'); $table->integer('access');
            $table->jsonb('source_data'); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('joomla_menus'); }
};
