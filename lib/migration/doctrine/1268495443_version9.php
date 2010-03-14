<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version9 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('site_widget', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'text' => 
             array(
              'type' => 'clob',
              'extra' => 'markdown',
              'notnull' => '1',
              'length' => '',
             ),
             'code' => 
             array(
              'type' => 'clob',
              'extra' => 'markdown',
              'notnull' => '1',
              'length' => '',
             ),
             'is_active' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'position' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'version' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('site_widget_version', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'primary' => '1',
             ),
             'text' => 
             array(
              'type' => 'clob',
              'extra' => 'markdown',
              'notnull' => '1',
              'length' => '',
             ),
             'code' => 
             array(
              'type' => 'clob',
              'extra' => 'markdown',
              'notnull' => '1',
              'length' => '',
             ),
             'is_active' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'position' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'version' => 
             array(
              'primary' => '1',
              'type' => 'integer',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
              1 => 'version',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('site_widget');
        $this->dropTable('site_widget_version');
    }
}