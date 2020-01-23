<?php

use yii\db\Migration;

/**
 * Class m200123_170912_user
 */
class m200123_170912_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'username' => 'varchar(255)',
            'password' => 'varchar(255)',
            'role' => 'varchar(255)',
            'token' => 'varchar(255)'
        ]);

        $this->insert('user', [
            'id' => '1',
            'username' => 'admin',
            'password' => '$2y$13$KVAlKwfzgH22K/lHQDWtautPjfMmVyzTOvc9T9QghYmsKf0UiKhfi',
            'role' => 'admin',
            'token' => 'd78c03d72e72b44a131d255aec3c8a11'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
