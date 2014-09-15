<?php

class m131030_113733_pupolate_for_users_module extends CDbMigration
{
    public function up()
    {
        $this->insert(
            'group',
            array(
                "id" => 1,
                "name" => "user",
                "description" => "Group for users",
            )
        );
        $this->insert(
            'group',
            array(
                "id" => 2,
                "name" => "Administrator",
                "description" => "Group for administrators",
            )
        );
    }

    public function down()
    {
        $this->truncateTable('group');
        echo "m131030_113733_pupolate_for_users_module does not support migration down.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
