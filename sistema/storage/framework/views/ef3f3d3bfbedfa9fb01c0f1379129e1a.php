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
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-slate-800">🛡️ Consola de Administración</h1>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">SUPER USUARIO</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="text-xl font-bold text-blue-700"><?php echo e(\App\Models\User::count()); ?></h3>
                        <p class="text-sm text-blue-900">Usuarios Totales</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <h3 class="text-xl font-bold text-green-700">$<?php echo e(\App\Models\Poliza::sum('cobertura')); ?></h3>
                        <p class="text-sm text-green-900">Fondo Asegurado Global</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <h3 class="text-xl font-bold text-purple-700"><?php echo e(\App\Models\User::where('rol', 'medico')->count()); ?></h3>
                        <p class="text-sm text-purple-900">Médicos Activos</p>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-700 mb-4">Gestión de Usuarios</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-2 px-4 border-b text-left">ID</th>
                                <th class="py-2 px-4 border-b text-left">Nombre</th>
                                <th class="py-2 px-4 border-b text-left">Email</th>
                                <th class="py-2 px-4 border-b text-left">Rol</th>
                                <th class="py-2 px-4 border-b text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = \App\Models\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b"><?php echo e($u->id); ?></td>
                                <td class="py-2 px-4 border-b font-bold"><?php echo e($u->name); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo e($u->email); ?></td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-2 py-1 rounded text-xs font-bold
                                        <?php echo e($u->rol == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                           ($u->rol == 'medico' ? 'bg-teal-100 text-teal-800' : 'bg-blue-100 text-blue-800')); ?>">
                                        <?php echo e(strtoupper($u->rol)); ?>

                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <?php if($u->id !== Auth::id()): ?> <form action="<?php echo e(route('profile.destroy')); ?>" method="POST" onsubmit="return confirm('¿Eliminar usuario permanentemente?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <input type="hidden" name="user_id_to_delete" value="<?php echo e($u->id); ?>"> 
                                            <button type="button" onclick="alert('En producción: Usuario eliminado. (Simulado por seguridad en Demo)')" class="text-red-600 hover:text-red-900 font-bold text-sm">
                                                🗑 Eliminar
                                            </button><a href="<?php echo e(route('admin.edit', $u->id)); ?>" class="text-indigo-600 hover:text-indigo-900 font-bold mr-3">✏️ Editar</a>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-xs">Actual</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
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