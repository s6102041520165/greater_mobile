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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
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
        ], $tableOptions);

        $this->addForeignKey(
            'fk-customer-user_id',
            'customer',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer}}');
    }
}
