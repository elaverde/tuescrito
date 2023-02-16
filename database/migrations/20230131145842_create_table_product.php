<?php

use \Migrations\Migration;

class CreateTableProduct extends Migration
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
        $this->schema->create('product', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('name',50);
            $table->text('description');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
    public function down()
    {
        $this->schema->drop('product');
    }
}
