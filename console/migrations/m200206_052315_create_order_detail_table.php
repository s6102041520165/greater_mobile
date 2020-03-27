<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_detail}}`.
 */
class m200206_052315_create_order_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%order_detail}}', [
            'id' => $this->primaryKey(),
            'orders_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-order_detail-product_id',
            'order_detail',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order_detail-order_id',
            'order_detail',
            'orders_id',
            'orders',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_detail}}');
    }
}
