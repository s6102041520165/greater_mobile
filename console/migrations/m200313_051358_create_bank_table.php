<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bank}}`.
 */
class m200313_051358_create_bank_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bank}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'bank' => $this->string(100)->notNull(),
            'bank_number' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bank}}');
    }
}
