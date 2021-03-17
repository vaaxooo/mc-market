<?php
namespace app\models;

use yii\db\ActiveRecord;

class Rating extends ActiveRecord{
    
    public static function tableName(){
        return '{{rating}}';
    }
}