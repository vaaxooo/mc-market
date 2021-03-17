<?php

namespace app\models\cabinet\items;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use app\models\Payouts;
use yii\helpers\Url;
use app\models\Rating;
use app\models\Items;
use app\models\HistorySells;
use app\models\Notifications;

class BuyItem extends Model{
    public $id;

    public function rules(){
        return [
            [['id'], 'required'],
        ];
    }

    public function sendNotification($seller, $item){
        $notification = new Notifications();
        $notification->title = "Продажа товара";
        $notification->message = "У вас купили товар ".$item;
        $notification->date = new \yii\db\Expression('NOW()');
        $notification->account = $seller;
        $notification->save();
    }

    public function BuyItem($id){
        if($this->validate()){
            if(isset(Yii::$app->session['email'])){
                $item = Items::find()->where(['id' => $id])->one();
                $seller = Cabinet::find()->where(['email' => $item->account])->one();
                $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
                if($userData->balance >= $item->price){
                    $userData->balance = $userData->balance - $item->price;
                    $userData->save();
                    $seller->balance = $seller->balance + $item->price;
                    $seller->save();
                    $history = new HistorySells();
                    $history->name = $item->name;
                    $history->email = Yii::$app->session['email'];
                    $history->account = $item->account;
                    $history->date = new \yii\db\Expression('NOW()');
                    $history->price = $item->price;
                    $history->itemId = $item->id;
                    $history->save();
                    $this->sendNotification($item->account, $item->name);
                    return Yii::$app->response->refresh();
                }else{
                    return Yii::$app->session->setFlash('error', 'У вас недостаточно средств на балансе');
                }
            }else{
                return Yii::$app->session->setFlash('error', 'Перед покупкой товара нужно авторизоваться!');
            }
        }else{
            return false;
        }
    }
}

?>