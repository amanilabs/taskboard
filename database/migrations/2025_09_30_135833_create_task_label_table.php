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
        Schema::create('task_label', function (Blueprint $t) {
            $t->unsignedBigInteger('task_id');
            $t->unsignedBigInteger('label_id');

            // be explicit about parent tables
            $t->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();
            $t->foreign('label_id')->references('id')->on('labels')->cascadeOnDelete();

            $t->primary(['task_id','label_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_label');
    }
};
