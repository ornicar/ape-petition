<?php

/**
 * BaseDmSentMail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $header
 * @property string $description
 * 
 * @method string     getName()        Returns the current record's "name" value
 * @method string     getHeader()      Returns the current record's "header" value
 * @method string     getDescription() Returns the current record's "description" value
 * @method DmSentMail setName()        Sets the current record's "name" value
 * @method DmSentMail setHeader()      Sets the current record's "header" value
 * @method DmSentMail setDescription() Sets the current record's "description" value
 * 
 * @package    ape-petition
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7294 2010-03-02 17:59:20Z jwage $
 */
abstract class BaseDmSentMail extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dm_sent_mail');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('header', 'string', 60000, array(
             'type' => 'string',
             'length' => '60000',
             ));
        $this->hasColumn('description', 'string', 60000, array(
             'type' => 'string',
             'length' => '60000',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}