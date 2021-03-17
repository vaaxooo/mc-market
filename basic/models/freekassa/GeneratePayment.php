<?php

namespace app\models\freekassa;

use Yii;
use yii\base\Model;
use app\models\Servers;
use app\models\Cabinet;
use yii\helpers\Url;

class GeneratePayment extends Model{
    public $amount, $order_id;
    public $secret_key = 'w8vnim6b';
    public $merchant_id = 102834;

    public function rules(){
        return [
            [['amount'], 'integer'],
        ];
    }
    
    public function GeneratePayment(){
        if($this->validate()){
            if($this->amount >= 10 && $this->amount <= 15000){
                $this->order_id = Yii::$app->session['email'];
                $sign = md5($this->merchant_id.':'.$this->amount.':'.$this->secret_key.':'.$this->order_id);
                return Yii::$app->response->redirect(Url::to("http://www.free-kassa.ru/merchant/cash.php?m={$this->merchant_id}&oa={$this->amount}&o={$this->order_id}&s={$sign}"));
            }else{
                return Yii::$app->session->setFlash('error', Yii::t('language', 'Сумма должна быть от 10 до 15.000 рублей!'));
            }
        }else{
            return false;
        }
    }
}

?>