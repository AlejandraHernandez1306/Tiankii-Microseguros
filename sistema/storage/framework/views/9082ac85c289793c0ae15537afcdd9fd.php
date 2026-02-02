<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiankii - Salud Rural</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">

    <nav class="bg-white shadow-md p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-3xl">🏥</span>
                <span class="text-2xl font-black text-blue-900 tracking-tighter">TIANKII</span>
            </div>
            <div class="space-x-4">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="font-bold text-blue-700 hover:text-blue-900">Ir al Panel</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="font-bold text-gray-600 hover:text-blue-600">Iniciar Sesión</a>
                    <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 text-white px-5 py-2 rounded-full font-bold hover:bg-blue-700 transition">Afiliarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2 space-y-6">
            <h1 class="text-5xl font-black text-gray-900 leading-tight">
                Salud accesible <br> <span class="text-blue-600">donde estés.</span>
            </h1>
            <p class="text-xl text-gray-600">
                Microseguros diseñados para zonas rurales. Sin trámites complejos. 
                Paga solo lo justo según tu edad y ubicación.
            </p>
            <div class="flex gap-4 pt-4">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="px-8 py-4 bg-blue-600 text-white rounded-lg font-bold shadow-lg hover:bg-blue-700 transition">
                        Entrar a mi Cuenta
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-blue-600 text-white rounded-lg font-bold shadow-lg hover:bg-blue-700 transition">
                        Comenzar Ahora
                    </a>
                    <a href="<?php echo e(route('login')); ?>" class="px-8 py-4 bg-white text-blue-600 border border-blue-200 rounded-lg font-bold shadow-sm hover:bg-gray-50 transition">
                        Soy Médico
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="md:w-1/2 grid gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-xl border-l-8 border-green-500">
                <div class="text-green-600 font-bold mb-2">PLAN BÁSICO</div>
                <div class="text-3xl font-black text-gray-800">$50.00 <span class="text-sm font-normal text-gray-500">/ año</span></div>
                <p class="text-gray-500 mt-2">Cobertura esencial para zonas de bajo riesgo.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-xl border-l-8 border-orange-500 opacity-90">
                <div class="text-orange-600 font-bold mb-2">PLAN RURAL PLUS</div>
                <div class="text-3xl font-black text-gray-800">$60.00 <span class="text-sm font-normal text-gray-500">/ año</span></div>
                <p class="text-gray-500 mt-2">Cobertura ampliada para zonas de alto riesgo.</p>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/welcome.blade.php ENDPATH**/ ?>