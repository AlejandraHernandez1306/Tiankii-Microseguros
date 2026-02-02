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
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border-l-4 border-indigo-500">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-indigo-800 mb-4">Panel de Administración</h1>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="p-3 font-bold">Nombre</th>
                                    <th class="p-3 font-bold">Email</th>
                                    <th class="p-3 font-bold">Rol</th>
                                    <th class="p-3 font-bold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = \App\Models\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3"><?php echo e($u->name); ?></td>
                                    <td class="p-3"><?php echo e($u->email); ?></td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                            <?php echo e($u->rol == 'admin' ? 'bg-indigo-100 text-indigo-800' : 
                                               ($u->rol == 'medico' ? 'bg-teal-100 text-teal-800' : 'bg-gray-100 text-gray-800')); ?>">
                                            <?php echo e($u->rol); ?>

                                        </span>
                                    </td>
                                    <td class="p-3 flex gap-2">
                                        <a href="<?php echo e(route('admin.edit', $u->id)); ?>" class="text-blue-600 font-bold text-sm">Editar</a>
                                        <form action="<?php echo e(route('admin.destroy', $u->id)); ?>" method="POST" onsubmit="return confirm('¿Eliminar?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="text-red-600 font-bold text-sm">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>