<?php

namespace app\models\cabinet;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use yii\helpers\Url;

class Login extends Model{
    public $name;
    public $password;

    public function rules(){
        return [
            [['name', 'password'], 'required'],
        ];
    }

    public function userLogin(){
        if($this->validate()){
            $userData = Cabinet::find()->where(['email' => $this->name])->one();
            if($userData != null && Yii::$app->getSecurity()->validatePassword($this->password, $userData->password)){
                if($userData->type == "unbanned") {
                    $session = Yii::$app->session;
                    $session->open();
                    $session['email'] = $this->name;
                    if($userData->admin == "true"){
                        $session['admin'] = $this->name;
                    }
                    return Yii::$app->response->redirect(Url::to('/index'));
                }else{
                    return Yii::$app->session->setFlash('error', 'Ваш аккаунт заблокирован! Свяжитесь с Администратором!');
                }
            }else{
                return Yii::$app->session->setFlash('error', 'E-mail или Пароль неверный!');
                $this->context->break;
            }
        }else{
            return false;
        }
    }
}

?>