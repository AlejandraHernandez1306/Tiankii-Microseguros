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
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-teal-800">🩺 Panel Médico</h1>
                    <p>Bienvenido Dr. <?php echo e(Auth::user()->name); ?></p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold mb-4">Nueva Consulta</h3>
                    <form action="<?php echo e(route('medico.registrar')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="email" name="email" placeholder="Correo Paciente" class="w-full border rounded mb-2 p-2" required>
                        <textarea name="diagnostico" placeholder="Diagnóstico" class="w-full border rounded mb-2 p-2"></textarea>
                        <button class="bg-teal-600 text-white w-full py-2 rounded font-bold">Guardar Consulta</button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold mb-4">Pacientes Recientes</h3>
                    <ul>
                        <?php $__currentLoopData = \App\Models\User::where('rol', 'paciente')->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="border-b py-2 flex justify-between">
                            <span><?php echo e($p->name); ?></span>
                            <span class="text-sm text-gray-500"><?php echo e($p->email); ?></span>
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
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/dashboard.blade.php ENDPATH**/ ?>