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
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow border-l-4 border-indigo-600">
                    <p class="text-gray-500">Usuarios Totales</p>
                    <p class="text-2xl font-bold"><?php echo e($users->total()); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-green-600">
                    <p class="text-gray-500">Dinero Recaudado</p>
                    <p class="text-2xl font-bold">$<?php echo e(number_format($totalDinero ?? 0, 2)); ?></p>
                </div>
            </div>

            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden border-t-4 border-indigo-600">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Gestión de Usuarios</h1>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-3">Nombre</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Rol</th>
                                <th class="p-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3"><?php echo e($u->name); ?></td>
                                <td class="p-3"><?php echo e($u->email); ?></td>
                                <td class="p-3 uppercase font-bold text-xs"><?php echo e($u->rol); ?></td>
                                <td class="p-3 flex gap-2">
                                    <a href="<?php echo e(route('admin.edit', $u->id)); ?>" class="text-blue-600 font-bold">Editar</a>
                                    <form action="<?php echo e(route('admin.destroy', $u->id)); ?>" method="POST" onsubmit="return confirm('¿Borrar?');">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-red-600 font-bold">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="mt-4"><?php echo e($users->links()); ?></div>
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
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>