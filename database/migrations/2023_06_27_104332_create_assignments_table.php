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
            $table->string('company_name');
            $table->string('request_type');
            $table->string('description');
            $table->date('start_date');
            $table->enum('status', ['Assigned', 'Unassigned', 'In Progress', 'Completed']);
            $table->string('request_file')->nullable();
            $table->string('file_type')->nullable();
            $table->string('response')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('members_assigned')->nullable();
            $table->string('new_attachment')->nullable();
            $table->timestamps();
        });
    }
   /** $table->unsignedBigInteger('latest_message_id')->nullable();
            * $table->boolean('is_read')->default(false)->change();
            * $table->boolean('is_admin_reply')->default(false)->change();
            * $table->foreign('latest_message_id')->references('id')->on('messages')->onDelete('set null'); 
    */
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
