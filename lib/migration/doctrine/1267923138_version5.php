<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('petition_dm_tag', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'primary' => '1',
             ),
             'dm_tag_id' => 
             array(
              'primary' => '1',
              'type' => 'integer',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
              1 => 'dm_tag_id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('petition_dm_tag');
    }
}