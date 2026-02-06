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
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-teal-100">
                    <div class="text-teal-500 text-3xl mb-2">👥</div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Pacientes</p>
                    <p class="text-3xl font-black text-gray-800"><?php echo e($totalPacientes); ?></p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-100">
                    <div class="text-blue-500 text-3xl mb-2">📋</div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Consultas</p>
                    <p class="text-3xl font-black text-gray-800"><?php echo e($consultasMes); ?></p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-100">
                    <div class="text-emerald-500 text-3xl mb-2">💰</div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Ingresos</p>
                    <p class="text-3xl font-black text-gray-800">$<?php echo e(number_format($ingresos, 2)); ?></p>
                </div>
                <div class="bg-teal-600 p-6 rounded-2xl shadow-lg text-white">
                    <div class="text-3xl mb-2">🏥</div>
                    <p class="text-teal-100 text-xs font-bold uppercase tracking-widest">Estado</p>
                    <p class="text-xl font-bold">Servicio Activo</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-teal-100 text-teal-600 p-2 rounded-lg">✍️</div>
                        <h3 class="font-black text-2xl text-gray-800 tracking-tight">Nueva Consulta Médica</h3>
                    </div>
                    
                    <form action="<?php echo e(route('medico.registrar')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Correo del Paciente</label>
                                <input type="email" name="email_paciente" class="w-full border-gray-200 rounded-xl bg-gray-50 focus:ring-teal-500" required placeholder="paciente@tiankii.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Honorarios ($)</label>
                                <input type="number" step="0.01" name="costo" class="w-full border-gray-200 rounded-xl bg-gray-50 focus:ring-teal-500" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Diagnóstico Detallado</label>
                            <textarea name="diagnostico" class="w-full border-gray-200 rounded-xl bg-gray-50 h-32" required></textarea>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Receta / Tratamiento</label>
                            <textarea name="receta" class="w-full border-gray-200 rounded-xl bg-gray-50 h-24" placeholder="Ej: Acetaminofén 500mg cada 8 horas..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-4 rounded-2xl font-black shadow-xl shadow-teal-100 transition-all transform hover:scale-[1.02]">
                            GUARDAR Y GENERAR EXPEDIENTE
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-6 border-b pb-4">📂 Directorio Reciente</h3>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 bg-gray-50 rounded-xl flex justify-between items-center hover:bg-teal-50 transition border border-transparent hover:border-teal-100">
                            <div class="truncate mr-2">
                                <p class="font-bold text-gray-800 text-sm truncate"><?php echo e($p->name); ?></p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter"><?php echo e($p->email); ?></p>
                            </div>
                            <a href="<?php echo e(route('medico.ver_historial', $p->id)); ?>" class="bg-white text-teal-600 px-3 py-1 rounded-lg text-[10px] font-black border border-teal-100 shadow-sm">VER</a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="mt-6">
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