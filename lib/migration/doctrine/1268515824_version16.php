<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version16 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('dm_user', 'slug', 'string', '255', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('dm_user', 'slug');
    }
}