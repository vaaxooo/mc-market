<?php

namespace app\models\cabinet;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use app\models\Notifications;
use yii\helpers\Url;

class Register extends Model{
    public $firstname, $lastname, $email, $password, $passwordTwo;

    public function rules(){
        return [
            [['firstname', 'lastname', 'email', 'password', 'passwordTwo'], 'trim'],
            [['firstname', 'lastname', 'email', 'password', 'passwordTwo'], 'required'],
            [['password'], 'string', 'length' => [6, 20]],
            ['email', 'email'],
        ];
    }

        public function sendNotification(){
        $notification = new Notifications();
        $notification->title = "Новый пользователь";
        $notification->message = "Поздравляем вас с регистрацией! =)";
        $notification->date = new \yii\db\Expression('NOW()');
        $notification->account = Yii::$app->session['email'];
        $notification->save();
    }
    
    public function userRegister(){
        if($this->validate()){
            if($this->password == $this->passwordTwo){
                $userData = Cabinet::find()->where(['email' => $this->email])->one();
                if($userData == null){
                    if(count(Cabinet::find()->where(['ip' => $_SERVER['REMOTE_ADDR']])->all()) != 2){
                        $user = new Cabinet();
                        $user->firstname = $this->firstname;
                        $user->lastname = $this->lastname;
                        $user->email = $this->email;
                        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                        $user->date = new \yii\db\Expression('NOW()');
                        $user->ip = $_SERVER['REMOTE_ADDR'];
                        $user->save();
                        $session = Yii::$app->session;
                        $session->open();
                        $session['email'] = $this->email;
                        $this->sendNotification();
                        return Yii::$app->response->redirect(Url::to('/index'));
                    }else{
                        return Yii::$app->session->setFlash('errorRegister', 'Вы можете иметь на сайте только 2 аккаунта!');
                    }
                }else{
                    return Yii::$app->session->setFlash('errorRegister', 'Указанный E-mail уже используется на сайте!');
                }
            }else{
                return Yii::$app->session->setFlash('errorRegister', 'Введённые пароли не совпадают!');
            }
        }else{
            return false;
        }
    }
}

?>