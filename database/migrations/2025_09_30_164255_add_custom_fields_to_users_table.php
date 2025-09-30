<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_tlp')->nullable()->after('email');
            $table->string('nip')->unique()->nullable()->after('no_tlp');
            $table->string('nidn_nuptk')->unique()->nullable()->after('nip');
            $table->string('program_studi')->nullable()->after('nidn_nuptk');
            $table->string('fakultas')->nullable()->after('program_studi');
            $table->string('signature_path')->nullable()->after('fakultas');
            $table->enum('role', ['auditee', 'auditor', 'admin'])->default('auditee')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_tlp', 'nip', 'nidn_nuptk', 'program_studi', 'fakultas', 'signature_path', 'role']);
        });
    }
};