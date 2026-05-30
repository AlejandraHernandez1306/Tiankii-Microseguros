<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 mb-6 border-t-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800"><?php echo e($paciente->name); ?></h1>
                        <p class="text-gray-500"><?php echo e($paciente->email); ?></p>
                        <div class="mt-2 text-sm">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">DUI: <?php echo e($paciente->paciente->dui ?? 'N/A'); ?></span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Zona: <?php echo e($paciente->paciente->ubicacion_zona ?? 'N/A'); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-500 hover:text-gray-700 font-bold">← Volver</a>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-4">Historial de Atenciones</h3>
            
            <?php $__empty_1 = true; $__currentLoopData = $paciente->atenciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atencion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white shadow rounded-lg p-6 mb-4 border-l-4 border-teal-400">
                <div class="flex justify-between mb-2">
                    <span class="font-bold text-teal-700">Dr. <?php echo e($atencion->medico->name ?? 'Desconocido'); ?></span>
                    <span class="text-gray-500 text-sm"><?php echo e($atencion->created_at->format('d/m/Y H:i')); ?></span>
                </div>
                <div class="mb-3">
                    <p class="font-bold text-xs text-gray-500 uppercase">Diagnóstico</p>
                    <p class="text-gray-800"><?php echo e($atencion->diagnostico); ?></p>
                </div>
                <div class="mb-3">
                    <p class="font-bold text-xs text-gray-500 uppercase">Receta</p>
                    <p class="text-gray-800"><?php echo e($atencion->receta); ?></p>
                </div>
                <div class="grid grid-cols-3 gap-4 text-sm bg-gray-50 p-3 rounded">
                    <div>
                        <p class="text-xs text-gray-500">Total</p>
                        <p class="font-bold">$<?php echo e(number_format($atencion->costo_total, 2)); ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-green-600">Cubierto (Seguro)</p>
                        <p class="font-bold text-green-700">$<?php echo e(number_format($atencion->monto_cubierto, 2)); ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-red-600">Copago Paciente</p>
                        <p class="font-bold text-red-700">$<?php echo e(number_format($atencion->copago_paciente, 2)); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-8 text-gray-500 bg-white rounded shadow">
                No hay historial médico registrado para este paciente.
            </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/medico/historial.blade.php ENDPATH**/ ?>