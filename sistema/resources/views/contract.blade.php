<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contrato de Microseguro - Tiankii</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 print:p-0 print:bg-white">
    <div class="max-w-4xl mx-auto bg-white p-12 shadow-2xl rounded-lg border border-gray-200 print:shadow-none print:border-none">
        
        <div class="flex justify-between items-center border-b-2 border-blue-900 pb-6 mb-8">
            <h1 class="text-4xl font-bold text-blue-900">TIANKII</h1>
            <div class="text-right">
                <p class="text-sm text-gray-500">Contrato N°: {{ $poliza->id . '-' . date('Y') }}</p>
                <p class="text-sm text-gray-500">Fecha: {{ date('d/m/Y') }}</p>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mb-8 uppercase tracking-wide">Contrato de Adhesión al Microseguro Rural</h2>

        <div class="space-y-6 text-justify text-gray-700 leading-relaxed">
            <p>
                Por el presente documento, <strong>TIANKII S.A. de C.V.</strong> certifica la cobertura de seguro médico para:
            </p>
            
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                <p><strong>ASEGURADO:</strong> {{ $user->name }}</p>
                <p><strong>DUI/ID:</strong> {{ $paciente->id }}</p>
                <p><strong>ZONA DE COBERTURA:</strong> {{ $paciente->ubicacion_zona }}</p>
                <p><strong>PLAN CONTRATADO:</strong> {{ $poliza->nombre_plan }}</p>
            </div>

            <h3 class="text-lg font-bold text-slate-800 mt-6">CLÁUSULA 1: COBERTURA</h3>
            <p>La aseguradora se compromete a cubrir gastos médicos ambulatorios, consultas generales y exámenes de laboratorio hasta por un monto de <strong>${{ number_format($poliza->cobertura, 2) }}</strong>.</p>

            <h3 class="text-lg font-bold text-slate-800">CLÁUSULA 2: VIGENCIA</h3>
            <p>Este contrato tiene una vigencia mensual renovable automáticamente mediante el pago de la prima de <strong>${{ number_format($poliza->costo, 2) }}</strong>.</p>

            <div class="mt-12 flex justify-between pt-12">
                <div class="text-center w-1/3 border-t border-gray-400 pt-2">
                    <p class="font-bold">Firma Autorizada</p>
                    <p class="text-xs">Tiankii Seguros</p>
                </div>
                <div class="text-center w-1/3 border-t border-gray-400 pt-2">
                    <p class="font-bold">{{ $user->name }}</p>
                    <p class="text-xs">Asegurado</p>
                </div>
            </div>
        </div>

        <div class="mt-10 text-center print:hidden">
            <button onclick="window.print()" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 shadow-lg transition">
                🖨 IMPRIMIR / GUARDAR PDF
            </button>
            <a href="/dashboard" class="block mt-4 text-blue-600 hover:underline">Volver al Dashboard</a>
        </div>
    </div>
</body>
</html>