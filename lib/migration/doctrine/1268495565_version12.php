<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version12 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('site_widget', 'code', 'clob', '', array(
             'notnull' => '1',
             ));
        $this->changeColumn('site_widget_version', 'code', 'clob', '', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {

    }
}