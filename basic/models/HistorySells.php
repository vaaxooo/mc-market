<?php
namespace app\models;

use yii\db\ActiveRecord;

class HistorySells extends ActiveRecord{
    
    public static function tableName(){
        return '{{historysells}}';
    }
}