<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment}}`.
 */
class m200206_053123_create_payment_table extends Migration
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
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull()->unique(),
            'bank' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'amount' => $this->float(2)->notNull(),
            'date_pay' => $this->date()->notNull(),
            'time_pay' => $this->time()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(9),
            'image' => $this->string()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-payment-order_id',
            'payment',
            'order_id',
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
        $this->dropTable('{{%payment}}');
    }
}
