<?php

namespace app\models\cabinet;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use yii\helpers\Url;

class Edit extends Model{
    public $current_password, $new_password, $rec_password;

    public function rules(){
        return [
            [['current_password', 'new_password', 'rec_password'], 'trim'],
            [['current_password', 'new_password', 'rec_password'], 'required'],
            [['current_password', 'new_password', 'rec_password'], 'string', 'length' => [6,24]],
        ];
    }

    public function changePassword(){
        if($this->validate()){
            $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
            if($this->new_password == $this->rec_password){
                if(Yii::$app->getSecurity()->validatePassword($this->current_password, $userData->password)){
                    $userData->password = Yii::$app->getSecurity()->generatePasswordHash($this->new_password);
                    $userData->update();
                    return Yii::$app->response->redirect(Url::to('/cabinet/logout'));
                }else{
                    return Yii::$app->session->setFlash('errorChange', Yii::t('language', 'Текущий пароль неверный!'));
                }
            }else{
                return Yii::$app->session->setFlash('errorChange', Yii::t('language', 'Введённые пароли не совпадают!'));
            }
        }else{
            return false;
        }
    }
}

?>