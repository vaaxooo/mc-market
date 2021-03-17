<?php
namespace app\models;

use yii\db\ActiveRecord;

class promocodes extends ActiveRecord{
    
    public static function tableName(){
        return '{{promocodes}}';
    }
}