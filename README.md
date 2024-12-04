
# FullTiss

## Descripción
Sistema desarrollado en **Laravel** para gestionar entregas de estudiantes, sprints de equipos y la calificación de proyectos en un Taller de Ingeniería de Software. Forma parte de la convocatoria pública **CPTIS-0893-2024** de la empresa **BORCELLE**.

### Características principales:
- **Gestión de entregas**: Los estudiantes entregan tareas organizadas y a tiempo.
- **Gestión de sprints**: Los equipos gestionan tareas dentro de un marco ágil.
- **Calificación y evaluación**: Docentes califican las entregas con un sistema de rubricas.
 
## Características
- **Gestión de usuarios**: Estudiantes, docentes y administradores con acceso a funciones específicas.
- **Asignación de tareas**: Creación de tareas con fechas de entrega.
- **Sprints y Scrum**: Organización de tareas en sprints.
- **Rubricas de evaluación**: Evaluación de entregas basada en rubricas.

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

     ```bash
    ├── app
    │   ├── Actions
    │   ├── Http
    │   │   ├── Controllers
    │   │   │   ├── AdminController.php
    │   │   │   ├── AssignmentController.php
    │   │   │   ├── EntregableController.php
    │   │   │   ├── EntregaController.php
    │   │   │   ├── EstudianteController.php
    │   │   │   ├── GrupoController.php
    │   │   │   ├── PermissionController.php
    │   │   │   ├── ProductBacklogController.php
    │   │   │   ├── QualificationController.php
    │   │   │   ├── RoleController.php
    │   │   │   ├── RubricaController.php
    │   │   │   ├── SeguimientoController.php
    │   │   │   ├── SprintareaController.php
    │   │   │   ├── SprintController.php
    │   │   │   ├── TareaController.php
    │   │   │   └── UserController.php
    │   │   └── Requests
    │   │       ├── AssignmentRequest.php
    │   │       ├── EntregableRequest.php
    │   │       ├── EntregaRequest.php
    │   │       ├── RubricaRequest.php
    │   │       ├── SprintareaRequest.php
    │   │       ├── SprintRequest.php
    │   │       └── TareaRequest.php
    │   ├── Models
    │   │   ├── Assignment.php
    │   │   ├── Entrega.php
    │   │   ├── Entregable.php
    │   │   ├── Grupo.php
    │   │   ├── Qualification.php
    │   │   ├── Rubrica.php
    │   │   ├── RubricaCriterio.php
    │   │   ├── RubricaNivel.php
    │   │   ├── Seguimiento.php
    │   │   ├── Sprint.php
    │   │   ├── Sprintarea.php
    │   │   ├── Tarea.php
    │   │   └── User.php
    │   ├── Providers
    │   └── View
    ├── bootstrap
    ├── config
    ├── database
    │   ├── factories
    │   ├── migrations
    │   │   ├── 0001_01_01_000000_create_users_table.php
    │   │   ├── 0001_01_01_000001_create_cache_table.php
    │   │   ├── 0001_01_01_000002_create_jobs_table.php
    │   │   ├── 2024_10_28_172843_add_two_factor_columns_to_users_table.php
    │   │   ├── 2024_10_28_172937_create_personal_access_tokens_table.php
    │   │   ├── 2024_10_28_173717_create_permission_tables.php
    │   │   ├── 2024_10_30_023856_create_assignments_table.php
    │   │   ├── 2024_10_30_193903_create_grupos_table.php
    │   │   ├── 2024_10_31_033909_create_sprints_table.php
    │   │   ├── 2024_11_06_031636_create_entregables_table.php
    │   │   ├── 2024_11_06_153825_create_tareas_table.php
    │   │   ├── 2024_11_06_172211_create_entregas_table.php
    │   │   ├── 2024_11_06_173212_create_grupo_tarea_table.php
    │   │   ├── 2024_11_08_121658_create_rubricas_table.php
    │   │   ├── 2024_11_09_112925_create_rubrica_criterio_table.php
    │   │   ├── 2024_11_09_112958_create_rubrica_nivel_table.php
    │   │   ├── 2024_11_20_231744_create_qualifications_table.php
    │   │   ├── 2024_11_30_233520_create_seguimientos_table.php
    │   │   ├── 2024_12_03_135550_create_sprintareas_table.php
    │   └── seeders
    ├── lang
    ├── node_modules
    ├── public
    ├── resources
    │   ├── views
    │   │   ├── admin
    │   │   ├── api
    │   │   ├── assignment
    │   │   ├── auth
    │   │   ├── components
    │   │   ├── docente
    │   │   ├── emails
    │   │   ├── entrega
    │   │   ├── entregable
    │   │   ├── estudiante
    │   │   ├── grupos
    │   │   ├── layouts
    │   │   ├── product-backlog
    │   │   ├── profile
    │   │   ├── qualifications
    │   │   ├── role-permission
    │   │   ├── seguimientos
    │   │   ├── sprint
    │   │   ├── sprintarea
    │   │   ├── tarea
    │   │   ├── dashboard.blade.php
    │   │   ├── navigation-menu.blade.php
    │   │   ├── policy.blade.php
    │   │   ├── terms.blade.php
    │   │   └── welcome.blade.php
    ├── routes
    ├── storage
    ├── tests
    ├── vendor
    ├── .editorconfig
    ├── .env
    ├── .env.example
    ├── .gitattributes
    ├── .gitignore
    ├── artisan
    ├── composer.json
    ├── composer.lock
    ├── package-lock.json
    ├── package.json
    ├── phpunit.xml
    ├── postcss.config.js
    ├── README.md
    ├── tailwind.config.js
    └── vite.config.js

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
