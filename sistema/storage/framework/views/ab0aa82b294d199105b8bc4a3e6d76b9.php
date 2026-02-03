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
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow border-l-4 border-teal-500">
                    <p class="text-gray-500 text-sm">Pacientes Totales</p>
                    <p class="text-2xl font-bold"><?php echo e(\App\Models\User::where('rol', 'paciente')->count()); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Consultas Realizadas</p>
                    <p class="text-2xl font-bold"><?php echo e(\App\Models\Atencion::where('medico_user_id', Auth::id())->count()); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">Ingresos del Mes</p>
                    <p class="text-2xl font-bold">$<?php echo e(\App\Models\Atencion::where('medico_user_id', Auth::id())->sum('costo_total')); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Estado del Sistema</p>
                    <p class="text-lg font-bold text-green-600">En Línea ●</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md border border-gray-100">
                    <h3 class="font-bold text-lg mb-4 text-teal-800 border-b pb-2 flex items-center gap-2">
                        <span>📝</span> Registrar Nueva Consulta
                    </h3>
                    
                    <form action="<?php echo e(route('medico.registrar')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="col-span-2">
                                <label class="text-sm font-bold text-gray-700">Paciente (Email)</label>
                                <input type="email" name="email_paciente" class="w-full border-gray-300 rounded focus:ring-teal-500" required placeholder="ejemplo@tiankii.com">
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700">Costo Total ($)</label>
                                <input type="number" step="0.01" name="costo" class="w-full border-gray-300 rounded" required>
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700">Fecha</label>
                                <input type="text" value="<?php echo e(date('Y-m-d')); ?>" disabled class="w-full bg-gray-100 border-gray-300 rounded text-gray-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="text-sm font-bold text-gray-700">Diagnóstico Médico</label>
                            <textarea name="diagnostico" class="w-full border-gray-300 rounded h-24" required placeholder="Describe los síntomas y el diagnóstico..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="text-sm font-bold text-gray-700">Receta / Tratamiento</label>
                            <textarea name="receta" class="w-full border-gray-300 rounded h-20" placeholder="Medicamentos recetados..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded font-bold shadow-lg transition transform hover:scale-105">
                            GUARDAR Y GENERAR EXPEDIENTE
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 h-fit">
                    <h3 class="font-bold text-lg mb-4 text-gray-700 border-b pb-2">📂 Directorio</h3>
                    
                    <?php if($pacientes->count() > 0): ?>
                        <ul class="space-y-3">
                            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex justify-between items-center p-3 bg-gray-50 rounded hover:bg-teal-50 transition border border-gray-200">
                                <div class="truncate">
                                    <p class="font-bold text-gray-800 text-sm"><?php echo e($p->name); ?></p>
                                    <p class="text-xs text-gray-500 truncate"><?php echo e($p->email); ?></p>
                                </div>
                                <a href="<?php echo e(route('medico.ver_historial', $p->id)); ?>" class="text-white bg-teal-500 hover:bg-teal-600 px-3 py-1 rounded text-xs font-bold shadow-sm">
                                    Ver
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="mt-4 text-xs">
                            <?php echo e($pacientes->links()); ?>

                        </div>
                    <?php else: ?>
                        <p class="text-gray-500 text-sm text-center py-4">No hay pacientes registrados.</p>
                    <?php endif; ?>
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