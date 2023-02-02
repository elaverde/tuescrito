<?php

use \Migrations\Migration;

class CreateTablePurchaseDetail extends Migration
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
        $this->schema->create('purchasedetail', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->unsignedInteger('id_shopping');
            $table->unsignedInteger('id_product');
            $table->integer('quantity');
            $table->float('price');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->foreign('id_shopping')->references('id')->on('shopping')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('product')->onDelete('cascade');
        });
    }
    public function down()
    {
        $this->schema->drop('purchasedetail');
    }
}
