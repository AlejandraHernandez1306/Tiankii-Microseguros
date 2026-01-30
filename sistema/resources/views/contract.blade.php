<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contrato Tiankii</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-12 shadow-2xl">
        <h1 class="text-3xl font-bold text-blue-900 border-b-2 border-blue-900 pb-4 mb-6">TIANKII SEGUROS</h1>
        
        <p class="text-right text-gray-500 mb-8">Fecha: {{ date('d/m/Y') }}</p>

        <h2 class="text-xl font-bold text-center mb-6">CERTIFICADO DE PÓLIZA DIGITAL</h2>

        <div class="space-y-4 text-justify mb-8">
            <p>Por medio del presente, se certifica que <strong>{{ $user->name }}</strong> con ID de afiliado <strong>{{ $paciente->id }}</strong>, cuenta con una póliza de microseguro activa.</p>
            
            <div class="bg-blue-50 p-4 rounded border border-blue-100">
                <p><strong>PLAN:</strong> {{ $poliza->nombre_plan }}</p>
                <p><strong>COBERTURA MÁXIMA:</strong> ${{ number_format($poliza->cobertura, 2) }}</p>
                <p><strong>COSTO MENSUAL:</strong> ${{ number_format($poliza->costo, 2) }}</p>
            </div>

            <p>Este contrato cubre servicios de medicina general y laboratorios en la red afiliada de zonas {{ $paciente->ubicacion_zona }}.</p>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-300 flex justify-between">
            <div class="text-center">
                <p class="font-bold">Firma Digital</p>
                <p class="text-xs">Tiankii S.A.</p>
            </div>
            <div class="text-center">
                <p class="font-bold">{{ $user->name }}</p>
                <p class="text-xs">Asegurado</p>
            </div>
        </div>

        <div class="mt-8 text-center print:hidden">
            <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">IMPRIMIR</button>
        </div>
    </div>
</body>
</html>