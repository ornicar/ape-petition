<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version21 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addIndex('collection', 'user_petition', array(
             'fields' => 
             array(
              0 => 'dm_user_id',
              1 => 'petition_id',
             ),
             'type' => 'unique',
             ));
    }

    public function down()
    {
        $this->removeIndex('collection', 'user_petition', array(
             'fields' => 
             array(
              0 => 'dm_user_id',
              1 => 'petition_id',
             ),
             'type' => 'unique',
             ));
    }
}