<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_logs', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 255);
            $table->string('file_path', 500);
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('file_hash', 64)->nullable();          // SHA-256 integrity checksum
            $table->string('type', 20)->default('manual');        // manual | scheduled
            $table->string('status', 20)->default('completed');   // completed | failed
            $table->foreignId('initiated_by')->nullable()->constrained('residents')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('created_at');
            $table->index(['status', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_logs');
    }
};
