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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('request_type');
            $table->string('description'); 
            $table->string('start_date');
            //$table->string('end_date');
            $table->string('company_name');
            $table->string('request');
            $table->string('response');
            $table->enum('status', ['Assigned', 'Unassigned', 'In Progress', 'Completed']);
            $table->boolean('is_active')->default('1');
            $table->json('members_assigned')->nullable();
            $table->string('new_attachment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
