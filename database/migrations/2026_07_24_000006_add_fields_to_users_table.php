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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            }
            if (!Schema::hasColumn('users', 'usertype')) {
                $table->string('usertype')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('usertype');
            }
            if (!Schema::hasColumn('users', 'nomor_anggota')) {
                $table->string('nomor_anggota')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('users', 'bukti_transfer')) {
                $table->string('bukti_transfer')->nullable()->after('nomor_anggota');
            }
            if (!Schema::hasColumn('users', 'profile')) {
                $table->string('profile')->nullable()->after('bukti_transfer');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'usertype', 'alamat', 'nomor_anggota', 'bukti_transfer', 'profile']);
        });
    }
};
