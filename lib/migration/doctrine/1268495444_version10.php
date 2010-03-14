<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version10 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('site_widget_version', 'site_widget_version_id_site_widget_id', array(
             'name' => 'site_widget_version_id_site_widget_id',
             'local' => 'id',
             'foreign' => 'id',
             'foreignTable' => 'site_widget',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('site_widget_version', 'site_widget_version_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('site_widget_version', 'site_widget_version_id_site_widget_id');
        $this->removeIndex('site_widget_version', 'site_widget_version_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
    }
}