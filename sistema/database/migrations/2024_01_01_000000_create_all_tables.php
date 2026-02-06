<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. USUARIOS
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rol')->default('paciente'); // admin, medico, paciente
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. TABLAS DE AUTENTICACIÓN (Requeridas por Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 3. PACIENTES (Perfil Médico)
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('dui')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('ubicacion_zona')->nullable();
            $table->timestamps();
        });

        // 4. PÓLIZAS (Seguro)
        Schema::create('polizas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->string('nombre_plan');
    $table->decimal('costo', 10, 2);
    $table->decimal('cobertura', 10, 2);
    $table->string('metodo_pago')->default('Tarjeta de Crédito'); // <--- AGREGAR ESTO
    $table->string('estado')->default('activa');
    $table->timestamps();
});

        // 5. ATENCIONES MÉDICAS (Consultas) - ¡ESTA ERA LA QUE FALTABA!
        Schema::create('atenciones_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medico_user_id')->constrained('users')->onDelete('cascade');
            $table->text('diagnostico');
            $table->text('receta')->nullable();
            $table->decimal('costo_total', 10, 2);
            $table->decimal('monto_cubierto', 10, 2);
            $table->decimal('copago_paciente', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atenciones_medicas');
        Schema::dropIfExists('polizas');
        Schema::dropIfExists('pacientes');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};