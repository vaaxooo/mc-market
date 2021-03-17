<?php

namespace app\models\admin;

use Yii;
use yii\base\Model;
use app\models\Servers;
use app\models\Cabinet;
use app\models\Promocodes;
use yii\helpers\Url;

class CreatePromocode extends Model{
    public $name, $percent, $count = 999;

    public function rules(){
        return [
            [['name', 'percent'], 'required'],
        ];
    }
    
    public function CreatePromocode(){
        if($this->validate()){
            if(count(Promocodes::find()->where(['name' => $this->name])->all()) == 0){
                $promocodes = new Promocodes();
                $promocodes->name = $this->name;
                $promocodes->percent = $this->percent;
                $promocodes->count = $this->count;
                $promocodes->save();
                return Yii::$app->response->refresh();
            }else{
                return Yii::$app->session->setFlash('error', Yii::t('language', 'Промокод с таким именем уже существует!'));
            }
        }else{
            return false;
        }
    }
}

?>