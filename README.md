==============================================================================
GUÍA DE INSTALACIÓN RÁPIDA - PROYECTO TIANKII (Laravel Herd + SQLite)
==============================================================================

IMPORTANTE: Este proyecto utiliza Laravel Herd y SQLite.

------------------------------------------------------------------------------
PASO 1: PREPARAR EL PROYECTO
------------------------------------------------------------------------------
1. Clona el repositorio.
2. Abre la terminal y entra a la carpeta del sistema:
   cd sistema

3. Instala las dependencias de PHP y Node.js:
   composer install
   npm install

------------------------------------------------------------------------------
PASO 2: CONFIGURACIÓN DE ENTORNO (Laravel Herd)
------------------------------------------------------------------------------
1. Crea tu archivo de configuración:
   (Windows): copy .env.example .env

2. Abre el archivo .env y configura la base de datos (borra lo demás de DB_):
   
   DB_CONNECTION=sqlite
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=laravel
   # DB_USERNAME=root
   # DB_PASSWORD=

   (Nota: Si usas Herd, asegura que CACHE_STORE=file en el .env si te da problemas)

3. Genera la llave de encriptación:
   php artisan key:generate

------------------------------------------------------------------------------
PASO 3: BASE DE DATOS (El paso crítico)
------------------------------------------------------------------------------
Como no usamos MySQL, debes crear el archivo de base de datos manualmente.

1. En tu terminal (dentro de carpeta 'sistema'), ejecuta:
   
   (Windows PowerShell): type nul > database/database.sqlite
   (Mac/Linux/Bash): touch database/database.sqlite

2. EJECUTA LA MIGRACIÓN MÁGICA:
   Este comando borra todo, crea las tablas correctas (incluyendo 'atenciones') 
   y crea los 3 usuarios obligatorios.

   php artisan migrate:fresh --seed

   (Si sale todo en verde, ya funcionó. Si falla, revisa el paso 1).

------------------------------------------------------------------------------
PASO 4: ESTILOS VISUALES 
------------------------------------------------------------------------------
Para que los botones tengan color y el diseño funcione:

   npm run build

------------------------------------------------------------------------------
PASO 5: INICIAR
------------------------------------------------------------------------------
Si usas Laravel Herd, el sitio ya debería estar visible.
Si no te carga, usa el servidor manual:

   php artisan serve

Entra a: http://127.0.0.1:8000

==============================================================================
CREDENCIALES DE ACCESO (ROLES)
==============================================================================

1. ADMINISTRADOR (Panel de Gestión)
   Email: admin@tiankii.com
   Clave: password

2. MÉDICO (Panel Clínico - Recetas y Consultas)
   Email: medico@tiankii.com
   Clave: password

3. PACIENTE (Portal de Salud - Credencial y Contrato)
   Email: paciente@tiankii.com
   Clave: password

==============================================================================
SOLUCIÓN DE PROBLEMAS COMUNES
==============================================================================
- Error "No such table: atenciones": Ejecuta 'php artisan migrate:fresh --seed'
- Error "Vite manifest not found": Ejecuta 'npm run build'
- Error "Table cache not found": Asegura que ejecutaste la migración completa.
- Login bloqueado: El proyecto ya tiene desactivada la verificación de email.
