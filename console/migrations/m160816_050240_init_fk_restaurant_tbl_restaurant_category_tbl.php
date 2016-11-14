<?php

use yii\db\Migration;

class m160816_050240_init_fk_restaurant_tbl_restaurant_category_tbl extends Migration
{
    public function up()
    {
        $this->addForeignKey("m160816_050240_init_fk_restaurant_tbl_restaurant_category_tbl", 'restaurant', 'restaurant_category_id', 'restaurant_category', 'id', "CASCADE", "RESTRICT");
    }

    public function down()
    {
        $this->dropForeignKey("m160816_050240_init_fk_restaurant_tbl_restaurant_category_tbl", "restaurant");
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
