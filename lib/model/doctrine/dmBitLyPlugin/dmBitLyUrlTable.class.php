<?php


class dmBitLyUrlTable extends PlugindmBitLyUrlTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('dmBitLyUrl');
    }
}