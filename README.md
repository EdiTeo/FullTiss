
# FullTiss

Sistema desarrollado en Laravel para la gestión de entregas, sprints y calificaciones. Este proyecto es parte de la solución para [descripción del problema].

## Tabla de Contenidos
1. [Requisitos](#requisitos)
2. [Instalación](#instalación)
3. [Estructura del Proyecto](#estructura-del-proyecto)


## Requisitos
- PHP 8.x
- Composer 2.x
- Node.js 16+
- MySQL 5.7+
- XAMPP (opcional)

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/usuario/nombre-repositorio.git
   cd nombre-repositorio
   bash
2. Instala dependencias de PHP y Node.js:
    ```bash
   composer install
   npm install
3. Copia y configura el archivo .env:
   ```bash
   cp .env.example .env
   php artisan key:generate
4. Configura la base de datos en el archivo .env y ejecuta las migraciones:
    ```bash
    php artisan migrate --seed
5. Compila los activos frontend:
    ```bash
    npm run dev
6. Inicia el servidor:
    ```bash
    php artisan serve

        ## Estructura del Proyecto
        FullTiss/
        ├── app/
        │   ├── Actions/
        │   ├── Http/
        │   │   ├── Controllers/
        │   │   │   ├── AdminController.php
        │   │   │   ├── AssignmentController.php
        │   │   │   ├── EntregableController.php
        │   │   │   ├── EntregaController.php
        │   │   │   ├── GrupoController.php
        │   │   │   ├── SprintController.php
        │   │   │   └── UserController.php
        │   │   ├── Requests/
        │   │       ├── AssignmentRequest.php
        │   │       ├── SprintRequest.php
        │   │       └── TareaRequest.php
        │   ├── Models/
        │       ├── Assignment.php
        │       ├── Entregable.php
        │       ├── Sprint.php
        │       └── User.php
        ├── bootstrap/
        ├── config/
        ├── database/
        │   ├── factories/
        │   ├── migrations/
        │   │   ├── 0001_create_users_table.php
        │   │   ├── 2024_create_sprints_table.php
        │   │   └── 2024_create_qualifications_table.php
        │   └── seeders/
        ├── lang/
        ├── node_modules/
        ├── public/
        ├── resources/
        │   ├── views/
        │   │   ├── admin/
        │   │   ├── auth/
        │   │   ├── sprint/
        │   │   └── welcome.blade.php
        │   ├── css/
        │   └── js/
        ├── routes/
        │   ├── api.php
        │   ├── channels.php
        │   ├── console.php
        │   └── web.php
        ├── storage/
        ├── tests/
        ├── vendor/
        ├── .env
        ├── artisan
        ├── composer.json
        ├── package.json
        └── README.md
## TECNOLOGIA UTILIZADAS
### Tecnologías Utilizadas
* Backend
* Lenguje: PHP 8.x
* Framework: Laravel
* Base de Datos: MySQL 5.7+
### Frontend
* Lenguaje: JavaScript/TypeScript
* Framework: Blade (Motor de plantillas de Laravel)
* CSS Framework: Tailwind CSS
* Herramienta de Construcción: Vite
