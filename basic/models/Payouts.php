<?php
namespace app\models;

use yii\db\ActiveRecord;

class Payouts extends ActiveRecord{
    
    public static function tableName(){
        return '{{payout}}';
    }
}