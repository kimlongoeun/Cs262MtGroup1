<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        // 'body' already exists from create_posts_table migration.
        // No renameColumn needed — nothing to do here.
    }
 
    public function down(): void
    {
        // Nothing to reverse.
    }
};
