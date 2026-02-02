<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. TABLA PACIENTES (Perfil Médico)
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación 1:1 Fuerte
            $table->string('telefono');
            $table->date('fecha_nacimiento'); // Vital para OES.2 (Cálculo por edad)
            $table->enum('ubicacion_zona', ['Bajo Riesgo', 'Alto Riesgo']); // Para el multiplicador 1.2x
            $table->timestamps();
        });

        // 2. TABLA POLIZAS (El Contrato)
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación 1:N
            $table->string('nombre_plan');
            $table->decimal('costo', 10, 2); // La Prima calculada
            $table->decimal('cobertura', 10, 2); // El saldo disponible
            $table->enum('estado', ['activa', 'vencida', 'cancelada'])->default('activa');
            $table->timestamps();
        });

        // 3. TABLA ATENCIONES (Historial Médico y Transacciones)
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_user_id')->constrained('users');
            $table->foreignId('medico_user_id')->constrained('users');
            $table->string('diagnostico');
            $table->text('receta')->nullable();
            $table->decimal('costo_total', 10, 2); // Costo real del servicio
            $table->decimal('monto_cubierto', 10, 2); // El 80% que cubre el seguro
            $table->decimal('copago_paciente', 10, 2); // El 20% que paga el paciente
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atenciones');
        Schema::dropIfExists('polizas');
        Schema::dropIfExists('pacientes');
    }
};