<?php

use yii\db\Migration;

class m160816_050240_init_fk_food_tbl_category_tbl extends Migration
{
    public function up()
    {
        $this->addForeignKey("fk_food_tbl_category_tbl", 'food', 'food_category_id', 'category', 'id', "CASCADE", "RESTRICT");
    }

    public function down()
    {
        $this->dropForeignKey("fk_food_tbl_category_tbl", "food");
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
