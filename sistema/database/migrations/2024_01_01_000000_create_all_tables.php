<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. TABLAS DEL SISTEMA (Cache, Sesiones - Lo que te daba error)
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 2. USUARIOS (Con el Rol arreglado)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rol')->default('paciente'); // <--- AQUÍ ESTÁ EL ROL
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. TABLAS DE TIANKII
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('dui')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('ubicacion_zona')->nullable();
            $table->timestamps();
        });

        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nombre_plan');
            $table->decimal('costo', 10, 2);
            $table->decimal('cobertura', 10, 2);
            $table->string('estado')->default('activa');
            $table->timestamps();
        });

        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_user_id')->constrained('users');
            $table->foreignId('medico_user_id')->constrained('users');
            $table->string('diagnostico');
            $table->text('receta')->nullable();
            $table->decimal('costo_total', 10, 2);
            $table->decimal('monto_cubierto', 10, 2);
            $table->decimal('copago_paciente', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Borrar todo si es necesario
        Schema::dropIfExists('atenciones');
        Schema::dropIfExists('polizas');
        Schema::dropIfExists('pacientes');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};