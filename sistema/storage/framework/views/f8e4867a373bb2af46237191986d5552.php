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
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-2xl shadow-xl p-8 text-white flex justify-between items-center border-b-4 border-blue-500">
                <div>
                    <h1 class="text-3xl font-black tracking-tight">Hola, <?php echo e(Auth::user()->name); ?> 👋</h1>
                    <p class="opacity-90 font-medium">Bienvenido a tu Portal de Salud Profesional Tiankii.</p>
                </div>
                <div class="text-right hidden sm:block bg-white/10 p-3 rounded-xl backdrop-blur-sm border border-white/20">
                    <p class="text-[10px] uppercase font-bold opacity-75">Estado de Póliza</p>
                    <p class="text-xl font-black text-green-400">● ACTIVA</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="font-black text-gray-800 text-lg mb-6 flex items-center gap-2">
                    <span class="bg-blue-100 p-2 rounded-lg text-blue-600">💰</span> Resumen de Cobertura y Pagos
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4"> 
                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100 hover:bg-white hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Prima Anual</p>
                        <p class="text-2xl font-black text-blue-600">
                            $<?php echo e(number_format(Auth::user()->polizas->first()->costo ?? 0, 2)); ?>

                        </p>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100 hover:bg-white hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Disponible</p>
                        <p class="text-2xl font-black text-emerald-600">
                            $<?php echo e(number_format(Auth::user()->polizas->first()->cobertura ?? 0, 2)); ?>

                        </p>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100 hover:bg-white hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Forma de Pago</p>
                        <div class="flex items-center gap-2 mt-1">
                            <?php
                                $metodo = Auth::user()->polizas->first()->metodo_pago ?? 'Bitcoin / Chivo';
                            ?>
                            
                            <?php if(str_contains(strtolower($metodo), 'bitcoin')): ?>
                                <span class="text-orange-500 font-bold text-xl">₿</span>
                            <?php else: ?>
                                <span class="text-blue-500 font-bold text-xl">💳</span>
                            <?php endif; ?>
                            
                            <p class="text-lg font-black text-gray-700 leading-none"><?php echo e($metodo); ?></p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl border border-gray-100 hover:bg-white hover:shadow-md transition">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Vencimiento</p>
                        <p class="text-lg font-bold text-gray-600 mt-1">
                            <?php echo e(\Carbon\Carbon::parse(Auth::user()->created_at)->addYear()->format('d/m/Y')); ?>

                        </p>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                    <p class="text-xs text-blue-700 italic flex items-center gap-2">
                        <span>ℹ️</span> El costo de tu prima fue calculado automáticamente basándose en tu ubicación 
                        (<?php echo e(Auth::user()->paciente->ubicacion_zona ?? 'N/A'); ?>) y edad actual.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-blue-600">
                        <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                            <span>🪪</span> Credencial Digital
                        </h3>
                        <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                            <div class="flex justify-between items-start mb-6">
                                <span class="font-black tracking-widest text-lg">TIANKII</span>
                                <div class="bg-white p-1 rounded-lg">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TIANKII-<?php echo e(Auth::user()->id); ?>" alt="QR" class="w-12 h-12">
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-[10px] opacity-75 uppercase font-bold">Asegurado Titular</p>
                                <p class="font-bold text-lg tracking-wide truncate uppercase"><?php echo e(Auth::user()->name); ?></p>
                            </div>
                            <div class="flex justify-between text-sm pt-4 border-t border-white/10">
                                <div>
                                    <p class="opacity-75 text-[10px] uppercase font-bold">Plan contratado</p>
                                    <p class="font-bold"><?php echo e(Auth::user()->polizas->first()->nombre_plan ?? 'Estándar Rural'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow border border-gray-100">
                        <a href="<?php echo e(route('contrato.ver')); ?>" target="_blank" class="flex items-center justify-between text-blue-900 font-black hover:text-blue-600 transition group">
                            <span class="flex items-center gap-2">
                                <span class="text-xl">📄</span> Descargar Contrato PDF
                            </span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h3 class="font-black text-gray-800 text-xl">🩺 Expediente Médico</h3>
                            <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-bold uppercase">Digitalizado</span>
                        </div>

                        <div class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $misAtenciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atencion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="p-6 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="bg-blue-100 text-blue-800 text-[10px] font-black px-2 py-1 rounded-md mb-2 inline-block uppercase">Consulta General</span>
                                        <h4 class="font-bold text-gray-800 text-lg leading-tight"><?php echo e($atencion->diagnostico); ?></h4>
                                    </div>
                                    <span class="text-sm font-bold text-gray-400"><?php echo e($atencion->created_at->format('d M, Y')); ?></span>
                                </div>
                                
                                <p class="text-sm text-gray-600 mb-4">
                                    Tratante: <span class="font-bold text-teal-600">Dr. <?php echo e($atencion->medico->name ?? 'Staff Médico'); ?></span>
                                </p>

                                <a href="<?php echo e(route('receta.imprimir', $atencion->id)); ?>" target="_blank" class="inline-flex items-center gap-2 text-sm font-black text-teal-600 hover:text-teal-800 border border-teal-200 bg-teal-50 px-4 py-2 rounded-xl transition shadow-sm hover:shadow">
                                    💊 Ver Receta Médica
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="p-16 text-center text-gray-400">
                                <div class="text-5xl mb-4 text-gray-200">📋</div>
                                <p class="font-medium">No se registran atenciones médicas en su historial.</p>
                            </div>
                            <?php endif; ?>
                        </div>
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