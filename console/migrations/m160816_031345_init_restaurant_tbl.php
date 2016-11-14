<?php

use yii\db\Migration;

class m160816_031345_init_restaurant_tbl extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%restaurant}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),   
            'detail' => $this->text()->notNull(),
            'image' => $this->string(50)->notNull(),
            'restaurant_category_id' => $this->integer()->notNull(),
            'address_id' => $this->integer()->notNull(),
            'time_open'=>$this->time()->notNull(),
            'time_close'=>$this->time()->notNull(),
            'price_min' => $this->integer()->notNull(),
            'price_max' => $this->integer()->notNull(),
            'point' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->boolean()->defaultValue(false),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%restaurant}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
