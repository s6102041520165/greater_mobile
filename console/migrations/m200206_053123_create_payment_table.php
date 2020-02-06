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
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'bank' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'amount' => $this->float(2)->notNull(),
            'date_pay' => $this->date()->notNull(),
            'time_pay' => $this->time()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(9),
            'image' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
    }
}
