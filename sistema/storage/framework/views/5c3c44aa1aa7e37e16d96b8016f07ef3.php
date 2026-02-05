<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Tiankii')); ?></title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            
                <main>
                <?php if(session('success')): ?>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 animate-bounce">
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow rounded flex justify-between items-center">
                            <div>
                                <strong class="font-bold">¡Excelente!</strong>
                                <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                            </div>
                            <span>✅</span>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow rounded">
                            <strong class="font-bold">Error:</strong>
                            <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php echo e($slot); ?>

            </main>
        </div>
    </body>
</html><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/layouts/app.blade.php ENDPATH**/ ?>