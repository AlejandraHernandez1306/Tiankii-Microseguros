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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edición de Usuario (Modo Dios)</h2>
                
                <form method="POST" action="<?php echo e(route('admin.update', $usuario->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700">Nombre</label>
                        <input type="text" name="name" value="<?php echo e($usuario->name); ?>" class="w-full border p-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700">Correo</label>
                        <input type="email" name="email" value="<?php echo e($usuario->email); ?>" class="w-full border p-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold text-gray-700">Rol de Sistema</label>
                        <select name="rol" class="w-full border p-2 rounded bg-gray-50">
                            <option value="paciente" <?php echo e($usuario->rol == 'paciente' ? 'selected' : ''); ?>>Paciente</option>
                            <option value="medico" <?php echo e($usuario->rol == 'medico' ? 'selected' : ''); ?>>Médico</option>
                            <option value="admin" <?php echo e($usuario->rol == 'admin' ? 'selected' : ''); ?>>Administrador</option>
                        </select>
                    </div>

                    <?php if($usuario->paciente): ?>
                    <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded">
                        <label class="block font-bold text-blue-800">Zona de Riesgo (Paciente)</label>
                        <select name="ubicacion_zona" class="w-full border p-2 rounded mt-1">
                            <option value="Bajo Riesgo" <?php echo e($usuario->paciente->ubicacion_zona == 'Bajo Riesgo' ? 'selected' : ''); ?>>Bajo Riesgo (Urbano)</option>
                            <option value="Alto Riesgo" <?php echo e($usuario->paciente->ubicacion_zona == 'Alto Riesgo' ? 'selected' : ''); ?>>Alto Riesgo (Rural)</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="<?php echo e(url('/dashboard')); ?>" class="text-gray-500 underline py-2">Cancelar</a>
                        <button type="submit" class="bg-blue-800 text-white font-bold py-2 px-6 rounded hover:bg-blue-900">
                            GUARDAR CAMBIOS
                        </button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/admin/edit.blade.php ENDPATH**/ ?>