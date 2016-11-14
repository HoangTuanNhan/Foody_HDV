<?php

use yii\db\Migration;

class m160816_050240_init_fk_city_tbl_district_tbl extends Migration
{
    public function up()
    {
        $this->addForeignKey("m160816_050240_init_fk_city_tbl_district_tbl", 'district', 'city_id', 'city', 'id', "CASCADE", "RESTRICT");
    }

    public function down()
    {
        $this->dropForeignKey("m160816_050240_init_fk_city_tbl_district_tbl", "district");
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
