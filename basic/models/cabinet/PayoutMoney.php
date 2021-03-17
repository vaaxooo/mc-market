<?php

namespace app\models\cabinet;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use app\models\Payouts;
use app\models\Notifications;
use yii\helpers\Url;

class PayoutMoney extends Model{
    public $payout_type, $wallet, $sum;

    public function rules(){
        return [
            [['payout_type', 'wallet', 'sum'], 'required'],
            [['wallet'], 'string', 'length' => [6, 21]],
            [['sum'], 'integer'],
        ];
    }

    public function sendNotification(){
        $notification = new Notifications();
        $notification->title = "Вывод средств";
        $notification->message = "Заявка на вывод средств создана!";
        $notification->date = new \yii\db\Expression('NOW()');
        $notification->account = Yii::$app->session['email'];
        $notification->save();
    }

    public function Payout(){
        if($this->validate()){
            $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
            if($this->sum >= 100 && $this->sum <= 15000){
                if($userData->balance >= $this->sum){
                    $userData->balance = $userData->balance - $this->sum;
                    $userData->update();
                    $payout = new Payouts();
                    $payout->payout_type = $this->payout_type;
                    $payout->wallet = $this->wallet;
                    $payout->sum = $this->sum;
                    $payout->date = new \yii\db\Expression('NOW()');
                    $payout->account = Yii::$app->session['email'];
                    $payout->save();
                    $this->sendNotification();
                    return Yii::$app->response->refresh();
                }else{
                    return Yii::$app->session->setFlash('error', 'На балансе недостаточно средств!');
                }
            }else{
                return Yii::$app->session->setFlash('error', 'Минимальная сумма вывода 100 рублей!');
            }
        }else{
            return false;
        }
    }
}

?>