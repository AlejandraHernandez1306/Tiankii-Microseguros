# 🏥 Tiankii - Microseguros de Salud Rural

Plataforma Fintech-Insurtech para la gestión de seguros médicos accesibles. Proyecto Final - Bootcamp Código Semilla.

## 🚀 Instalación Rápida (Para Jueces/Devs)

Este proyecto está construido en **PHP 8.2+ (Laravel 11)**. Requiere Node.js para los estilos.

### Pasos para correr en Local (Laravel Herd / Terminal):

1.  **Clonar y configurar:**
    ```bash
    git clone <URL_DEL_REPO>
    cd sistema
    cp .env.example .env
    composer install
    npm install && npm run build
    ```

2.  **Base de Datos:**
    Configure su base de datos en `.env` (o use SQLite por defecto).
    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```

3.  **Ejecutar:**
    ```bash
    php artisan serve
    ```
    Acceder a: `http://127.0.0.1:8000`

## 💡 Funcionalidades Clave (Demo)
* **Registro Inteligente:** Asignación automática de plan según zona (Rural/Urbana).
* **Panel del Médico:** Ruta `/medico` para registrar consultas y aplicar descuentos.
* **Historial Clínico:** El paciente ve sus atenciones y el saldo restante en tiempo real.

## 🛠 Stack Tecnológico
* Laravel Framework 11 (Backend PHP)
* TailwindCSS (Frontend Responsive)
* MySQL/SQLite (Base de Datos Relacional)
