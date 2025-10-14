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
         Schema::table('tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('tasks','title')) $table->text('title')->nullable();
            if (!Schema::hasColumn('tasks','description')) $table->text('description')->nullable();
            if (!Schema::hasColumn('tasks','position')) $table->nullable('position')->nullable();
            $table->dropColumn(['assigned_to']);
            $table->string('priority', 20)->default('medium');   // low|medium|high|urgent
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('attachment_mime', 100)->nullable();
            $table->string('attachment_name')->nullable();
            $table->json('assignee_ids')->nullable();
                        
   
     });
 }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
         $table->dropColumn(['priority','start_date','end_date','attachment_path','attachment_mime','attachment_name','assignee_ids']);
        });
    }
};
