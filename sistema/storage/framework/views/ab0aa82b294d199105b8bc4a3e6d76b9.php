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
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">🩺 Panel Médico</h1>
                        <p class="text-gray-500">Dr. <?php echo e(Auth::user()->name); ?></p>
                    </div>
                    <div class="bg-teal-50 text-teal-700 px-4 py-2 rounded-lg border border-teal-200">
                        Estado: <span class="font-bold">Activo</span>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
                    <h3 class="font-bold text-lg mb-4 text-teal-800 border-b pb-2">Nueva Consulta</h3>
                    <form action="<?php echo e(route('medico.registrar')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="space-y-3">
                            <input type="email" name="email_paciente" class="w-full border-gray-300 rounded focus:ring-teal-500 focus:border-teal-500" required placeholder="Correo del Paciente">
                            
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="costo" placeholder="Costo ($)" class="w-full border-gray-300 rounded">
                                <input type="text" placeholder="Fecha: Hoy" disabled class="w-full bg-gray-100 border-gray-300 rounded text-gray-500">
                            </div>

                            <textarea name="diagnostico" class="w-full border-gray-300 rounded h-24 focus:ring-teal-500" required placeholder="Escriba el diagnóstico aquí..."></textarea>
                            <textarea name="receta" class="w-full border-gray-300 rounded h-20 focus:ring-teal-500" placeholder="Receta médica..."></textarea>
                            
                            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded font-bold shadow-lg transition transform hover:scale-105">
                                GUARDAR CONSULTA
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
                    <h3 class="font-bold text-lg mb-4 text-gray-700 border-b pb-2">Directorio de Pacientes</h3>
                    <ul class="space-y-2">
                        <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex justify-between items-center p-3 bg-gray-50 rounded hover:bg-gray-100 transition">
                            <div>
                                <p class="font-bold text-gray-800"><?php echo e($p->name); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($p->email); ?></p>
                            </div>
                            <a href="<?php echo e(route('medico.ver_historial', $p->id)); ?>" class="text-blue-600 text-sm font-bold hover:text-blue-800">
                                Ver Historial →
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    
                    <div class="mt-4">
                        <?php echo e($pacientes->links()); ?>

                    </div>
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