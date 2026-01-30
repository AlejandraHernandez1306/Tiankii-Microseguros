<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Modificar tabla users para agregar rol
        Schema::table('users', function (Blueprint $table) {
            $table->enum('rol', ['paciente', 'medico', 'admin'])->default('paciente')->after('email');
        });

        // 2. Crear tabla pacientes
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('fecha_nacimiento');
            $table->enum('ubicacion_zona', ['Rural', 'Urbana']);
            $table->string('telefono');
            $table->timestamps();
        });

        // 3. Crear tabla polizas
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nombre_plan');
            $table->decimal('costo', 8, 2);
            $table->decimal('cobertura', 10, 2);
            $table->string('estado')->default('activa'); // activa, pendiente, cancelada
            $table->timestamps();
        });

        // Tabla para el Historial de Atenciones (Requisito Fase 3)
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_user_id')->constrained('users'); // El paciente
            $table->foreignId('medico_user_id')->constrained('users');   // El médico que atendió
            $table->string('diagnostico');
            $table->text('receta')->nullable(); // Aquí se guarda la medicina
            $table->decimal('costo', 10, 2);
            $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('polizas');
        Schema::dropIfExists('pacientes');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }
};