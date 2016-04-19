<?php

use yii\db\Migration;

class m160419_083847_create_administrator_login_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%administrator_login}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->defaultValue(''),//事件类型
            'uid' => $this->integer()->defaultValue(0),
            'username' => $this->string()->defaultValue(''),
            'ip' => $this->string()->defaultValue(''),
            'created_at' => $this->dateTime()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%administrator_login}}');
    }
}
