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
            
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-lg shadow-xl p-6 mb-8 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Hola, <?php echo e(Auth::user()->name); ?></h1>
                    <p class="opacity-90">Bienvenido a tu Portal de Salud Tiankii.</p>
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-sm opacity-75">Estado de Póliza</p>
                    <p class="text-xl font-bold text-green-400">● ACTIVA</p>
                </div>
            </div>

            <div class="mb-8 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="font-black text-gray-800 text-lg mb-4 flex items-center gap-2">
                    <span>💰</span> Estado de mi Seguro
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Prima Anual Pagada</p>
                        <p class="text-2xl font-black text-blue-600">
                            $<?php echo e(number_format(Auth::user()->polizas->first()->costo ?? 0, 2)); ?>

                        </p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Cobertura Disponible</p>
                        <p class="text-2xl font-black text-emerald-600">
                            $<?php echo e(number_format(Auth::user()->polizas->first()->cobertura ?? 0, 2)); ?>

                        </p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Próximo Pago</p>
                        <p class="text-sm font-bold text-gray-600">
                            <?php echo e(\Carbon\Carbon::parse(Auth::user()->created_at)->addYear()->format('d/m/Y')); ?>

                        </p>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                    <p class="text-xs text-blue-700 italic">
                        * El costo de tu prima fue calculado automáticamente basándose en tu ubicación 
                        (<?php echo e(Auth::user()->paciente->ubicacion_zona ?? 'N/A'); ?>) y edad actual.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-blue-600">
                        <h3 class="font-bold text-gray-800 text-lg mb-4">💳 Credencial Digital</h3>
                        <div class="bg-gray-800 rounded-xl p-6 text-white shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                            <div class="flex justify-between items-start mb-6">
                                <span class="font-bold tracking-widest text-lg">TIANKII</span>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TIANKII-<?php echo e(Auth::user()->id); ?>" alt="QR" class="w-14 h-14 bg-white p-1 rounded">
                            </div>
                            <div class="mb-4">
                                <p class="text-xs opacity-75 uppercase">Asegurado</p>
                                <p class="font-bold text-lg tracking-wide truncate"><?php echo e(strtoupper(Auth::user()->name)); ?></p>
                            </div>
                            <div class="flex justify-between text-sm">
                                <div>
                                    <p class="opacity-75 text-xs">Plan</p>
                                    <p class="font-bold"><?php echo e(Auth::user()->polizas->first()->nombre_plan ?? 'N/A'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition">
                        <a href="<?php echo e(route('contrato.ver')); ?>" target="_blank" class="flex items-center justify-between text-blue-800 font-bold hover:text-blue-600">
                            <span>📄 Descargar Contrato PDF</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                        <div class="p-6 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-bold text-gray-800 text-xl">🩺 Mi Historial Médico</h3>
                            <p class="text-sm text-gray-500">Consultas y recetas recientes</p>
                        </div>

                        <?php if($misAtenciones->count() > 0): ?>
                            <div class="divide-y divide-gray-100">
                                <?php $__currentLoopData = $misAtenciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atencion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-6 hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded mb-2 inline-block uppercase">Consulta General</span>
                                            <h4 class="font-bold text-gray-800"><?php echo e($atencion->diagnostico); ?></h4>
                                        </div>
                                        <span class="text-sm text-gray-500"><?php echo e($atencion->created_at->format('d M, Y')); ?></span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mb-4">
                                        <span class="font-bold">Dr. Tratante:</span> <?php echo e($atencion->medico->name ?? 'Staff Médico'); ?>

                                    </p>

                                    <a href="<?php echo e(route('receta.imprimir', $atencion->id)); ?>" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-teal-600 hover:text-teal-800 border border-teal-200 bg-teal-50 px-3 py-2 rounded transition">
                                        💊 Ver Receta Médica
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="p-12 text-center text-gray-500">
                                <p class="text-4xl mb-2">📋</p>
                                <p>Aún no tienes consultas registradas en el sistema.</p>
                            </div>
                        <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/dashboard.blade.php ENDPATH**/ ?>