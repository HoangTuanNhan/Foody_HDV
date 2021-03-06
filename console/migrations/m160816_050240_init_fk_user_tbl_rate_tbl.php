<?php

use yii\db\Migration;

class m160816_050240_init_fk_user_tbl_rate_tbl extends Migration
{
    public function up()
    {
        $this->addForeignKey("m160816_050240_init_fk_user_tbl_rate_tbl", 'rate', 'user_id', 'user', 'id', "CASCADE", "RESTRICT");
    }

    public function down()
    {
        $this->dropForeignKey("m160816_050240_init_fk_user_tbl_rate_tbl", "rate");
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
