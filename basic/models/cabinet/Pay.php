<?php

namespace app\models\cabinet;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use yii\helpers\Url;

class Pay extends Model{
    public $bonuses;

    public function rules(){
        return [
            [['bonuses'], 'required'],
            [['bonuses'], 'integer'],
        ];
    }

    public function transferBonuses(){
        if($this->validate()){
            $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
            if($userData->bonuses >= $this->bonuses){
                $money = $this->bonuses * 2;
                $userData->bonuses = $userData->bonuses - $this->bonuses;
                $userData->balance = $userData->balance + $money;
                $userData->update();
                return Yii::$app->response->refresh();
            }else{
                return Yii::$app->session->setFlash('error', Yii::t('language', 'У вас недостаточно бонусов!'));
            }
        }else{
            return false;
        }
    }
}

?>