<?php
namespace app\models;

use yii\db\ActiveRecord;

class Cabinet extends ActiveRecord{
    
    public static function tableName(){
        return '{{users}}';
    }
}