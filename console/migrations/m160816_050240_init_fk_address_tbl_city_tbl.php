<?php

use yii\db\Migration;

class m160816_050240_init_fk_address_tbl_city_tbl extends Migration
{
    public function up()
    {
        $this->addForeignKey("m160816_050240_init_fk_address_tbl_city_tbl", 'address', 'district_id', 'district', 'id', "CASCADE", "RESTRICT");
    }

    public function down()
    {
        $this->dropForeignKey("m160816_050240_init_fk_address_tbl_city_tbl", "address");
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
