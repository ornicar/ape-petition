<?php

/**
 * BasePartner
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property string $url
 * @property integer $image_id
 * @property Doctrine_Collection $Petitions
 * @property Doctrine_Collection $PartnerPetition
 * 
 * @method string              getTitle()           Returns the current record's "title" value
 * @method string              getUrl()             Returns the current record's "url" value
 * @method integer             getImageId()         Returns the current record's "image_id" value
 * @method Doctrine_Collection getPetitions()       Returns the current record's "Petitions" collection
 * @method Doctrine_Collection getPartnerPetition() Returns the current record's "PartnerPetition" collection
 * @method Partner             setTitle()           Sets the current record's "title" value
 * @method Partner             setUrl()             Sets the current record's "url" value
 * @method Partner             setImageId()         Sets the current record's "image_id" value
 * @method Partner             setPetitions()       Sets the current record's "Petitions" collection
 * @method Partner             setPartnerPetition() Sets the current record's "PartnerPetition" collection
 * 
 * @package    ape-petition
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7294 2010-03-02 17:59:20Z jwage $
 */
abstract class BasePartner extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('partner');
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => '255',
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'extra' => 'link',
             'length' => '255',
             ));
        $this->hasColumn('image_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Petition as Petitions', array(
             'refClass' => 'PartnerPetition',
             'local' => 'partner_id',
             'foreign' => 'petition_id'));

        $this->hasMany('PartnerPetition', array(
             'local' => 'id',
             'foreign' => 'partner_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $dmversionable0 = new Doctrine_Template_DmVersionable();
        $this->actAs($timestampable0);
        $this->actAs($dmversionable0);
    }
}