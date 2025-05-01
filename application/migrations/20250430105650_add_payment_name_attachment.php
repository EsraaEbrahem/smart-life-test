<?php
defined("BASEPATH") or exit ("No direct script access allowed");

class Migration_Add_payment_name_attachment extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'attachment' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'type',
                'default' => NULL
            )
        );
        $this->dbforge->add_column('payment_name', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('payment_name', 'attachment');
    }
}
