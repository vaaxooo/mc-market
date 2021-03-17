<?php
namespace app\models;

use yii\db\ActiveRecord;

class Invoices extends ActiveRecord{
    
    public static function tableName(){
        return '{{invoices}}';
    }
}