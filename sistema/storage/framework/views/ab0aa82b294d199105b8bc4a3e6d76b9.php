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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-teal-500">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-teal-700">🩺 Panel Médico</h1>
                    <p>Bienvenido, Dr. <?php echo e(Auth::user()->name); ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Nueva Consulta</h3>
                    <form action="<?php echo e(route('medico.registrar')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Correo del Paciente</label>
                                <input type="email" name="email_paciente" class="w-full border-gray-300 rounded" required placeholder="paciente@tiankii.com">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Costo ($)</label>
                                <input type="number" step="0.01" name="costo" class="w-full border-gray-300 rounded" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Diagnóstico</label>
                                <textarea name="diagnostico" class="w-full border-gray-300 rounded" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Receta</label>
                                <textarea name="receta" class="w-full border-gray-300 rounded"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded font-bold hover:bg-teal-700">
                                Guardar Consulta
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Pacientes Registrados</h3>
                    <ul>
                        <?php $__currentLoopData = \App\Models\User::where('rol', 'paciente')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex justify-between items-center py-3 border-b">
                            <div>
                                <p class="font-bold"><?php echo e($p->name); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($p->email); ?></p>
                            </div>
                            <a href="<?php echo e(route('medico.ver_historial', $p->id)); ?>" class="text-blue-600 text-sm font-bold hover:underline">
                                Ver Historial
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
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
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/medico/dashboard.blade.php ENDPATH**/ ?>