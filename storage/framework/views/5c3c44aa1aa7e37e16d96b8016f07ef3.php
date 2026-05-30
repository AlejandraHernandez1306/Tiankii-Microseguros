<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Tiankii')); ?></title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6" id="alert-success">
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 shadow-sm flex justify-between items-center rounded-r">
                            <div class="flex items-center">
                                <span class="text-green-500 text-xl mr-2">✓</span>
                                <p class="text-green-700 font-bold"><?php echo e(session('success')); ?></p>
                            </div>
                            <button onclick="document.getElementById('alert-success').style.display='none'" class="text-green-700 font-bold hover:text-green-900">×</button>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 shadow-sm rounded-r">
                            <p class="text-red-700 font-bold">Error</p>
                            <p class="text-red-600 text-sm"><?php echo e(session('error')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php echo e($slot); ?>

            </main>
        </div>
        <script>
    setTimeout(function() {
        let alert = document.getElementById('alert-success');
        if(alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>
    </body>
</html><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/layouts/app.blade.php ENDPATH**/ ?>