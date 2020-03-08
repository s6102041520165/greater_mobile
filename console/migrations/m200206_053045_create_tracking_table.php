<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tracking}}`.
 */
class m200206_053045_create_tracking_table extends Migration
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
        $this->createTable('{{%tracking}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'barcode' => $this->string(25)->notNull()->unique(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-tracking-order_id',
            'tracking',
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
        $this->dropTable('{{%tracking}}');
    }
}
