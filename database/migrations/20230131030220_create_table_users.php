<?php

use \Migrations\Migration;
use App\Models\User;
class CreateTableUsers extends Migration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $this->schema->create('users', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->string('name',50);
            $table->string('last_name',50);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('photo');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
        });
        $password = password_hash('user', PASSWORD_BCRYPT);
        User::create([
            'name' => 'Edilson',
            'last_name' => 'Laverde Molina',
            'email' => 'user',
            'password' => $password,
            'photo' => 'none',
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
       
    }
    public function down()
    {
        $this->schema->drop('users');
    }
}
