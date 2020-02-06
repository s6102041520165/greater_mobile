<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m200206_050755_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50)->notNull(),
            'district' => $this->string()->notNull(),
            'amphoe' => $this->string()->notNull(),
            'province' => $this->string()->notNull(),
            'zipcode' => $this->string()->notNull(),
            'telephone' => $this->string()->notNull(),
            'picture' => $this->string(),
            'user_id' => $this->integer()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer}}');
    }
}
