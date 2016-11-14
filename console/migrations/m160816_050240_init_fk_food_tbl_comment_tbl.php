<?php

use yii\db\Migration;

class m160816_050240_init_fk_food_tbl_comment_tbl extends Migration
{
    public function up()
    {
        $this->addForeignKey("m160816_050240_init_fk_food_tbl_comment_tbl", 'comment', 'food_id', 'food', 'id', "CASCADE", "RESTRICT");
    }

    public function down()
    {
        $this->dropForeignKey("m160816_050240_init_fk_food_tbl_comment_tbl", "comment");
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
