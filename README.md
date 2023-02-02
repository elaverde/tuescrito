# Script para ejecutar migraciones en Phinx

"migrate": "vendor/bin/phinx migrate -c config-phinx.php",
"create-migration": "vendor/bin/phinx create $1 -c config-phinx.php"

El script anterior define dos acciones para ejecutar en Phinx.

1. `migrate`: Ejecuta la migración de la base de datos según las definiciones en el archivo `config-phinx.php`.
2. `create-migration`: Crea una nueva migración en Phinx, donde `$1` representa el nombre de la migración. Deberás reemplazar `$1` con el nombre de la migración que deseas crear.

Al ejecutar cualquiera de estos comandos, Phinx seguirá las definiciones en el archivo `config-phinx.php` para actualizar o crear la base de datos.

'''
# Para ejecutar las migraciones existentes
composer migrate

# Para crear una nueva migración
composer create-migration NombreDeTuMigracion

'''