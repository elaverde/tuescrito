<?php

use \Migrations\Migration;

class CreateTableParameters extends Migration
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
        $this->schema->create('parameters', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->unsignedInteger('texts_id');
            $table->string('label',50);
            $table->string('key',50);
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->foreign('texts_id')->references('id')->on('id')->on('texts')->onDelete('cascade');

        });
    }
    public function down()
    {
        $this->schema->drop('parameters');
    }
}
