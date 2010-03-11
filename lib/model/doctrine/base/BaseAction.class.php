<?php

/**
 * BaseAction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $petition_id
 * @property string $title
 * @property clob $text
 * @property timestamp $begin_at
 * @property integer $objectif
 * @property boolean $is_active
 * @property Petition $Petition
 * 
 * @method integer   getPetitionId()  Returns the current record's "petition_id" value
 * @method string    getTitle()       Returns the current record's "title" value
 * @method clob      getText()        Returns the current record's "text" value
 * @method timestamp getBeginAt()     Returns the current record's "begin_at" value
 * @method integer   getObjectif()    Returns the current record's "objectif" value
 * @method boolean   getIsActive()    Returns the current record's "is_active" value
 * @method Petition  getPetition()    Returns the current record's "Petition" value
 * @method Action    setPetitionId()  Sets the current record's "petition_id" value
 * @method Action    setTitle()       Sets the current record's "title" value
 * @method Action    setText()        Sets the current record's "text" value
 * @method Action    setBeginAt()     Sets the current record's "begin_at" value
 * @method Action    setObjectif()    Sets the current record's "objectif" value
 * @method Action    setIsActive()    Sets the current record's "is_active" value
 * @method Action    setPetition()    Sets the current record's "Petition" value
 * 
 * @package    ape-petition
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
 */
abstract class BaseAction extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('action');
        $this->hasColumn('petition_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('text', 'clob', null, array(
             'type' => 'clob',
             'extra' => 'markdown',
             ));
        $this->hasColumn('begin_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('objectif', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 50,
             'unsigned' => true,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));


        $this->index('petition_title', array(
             'fields' => 
             array(
              0 => 'petition_id',
              1 => 'title',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Petition', array(
             'local' => 'petition_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $dmversionable0 = new Doctrine_Template_DmVersionable();
        $this->actAs($timestampable0);
        $this->actAs($dmversionable0);
    }
}