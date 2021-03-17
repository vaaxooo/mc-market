<?php
namespace app\models;

use yii\db\ActiveRecord;

class Notifications extends ActiveRecord{
    
    public static function tableName(){
        return '{{notifications}}';
    }
}