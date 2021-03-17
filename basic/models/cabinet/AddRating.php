<?php

namespace app\models\cabinet;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use app\models\Payouts;
use yii\helpers\Url;
use app\models\Rating;

class AddRating extends Model{
    public $captcha;

    public function rules(){
        return [
            [['captcha'], 'required'],
            ['captcha', 'captcha'],
        ];
    }

    public function AddRating($id){
        if($this->validate()){
            $userData = Cabinet::find()->where(['id' => $id])->one();
            if(count(Rating::find()->where(['account' => $userData->email, 'ip' => $_SERVER['REMOTE_ADDR']])->all()) == 0){
                $rating = new Rating();
                $rating->ip = $_SERVER['REMOTE_ADDR'];
                $rating->date = new \yii\db\Expression('NOW()');
                $rating->account = $userData->email;
                $rating->save();
                return Yii::$app->response->refresh();
            }else{
                return Yii::$app->session->setFlash('error', 'Вы уже ставили оценку данному пользователю!');
            }
        }else{
            return false;
        }
    }
}

?>