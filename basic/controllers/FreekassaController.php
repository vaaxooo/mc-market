<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Cabinet;
use app\models\Settings;
use app\models\freekassa\Result;
use app\models\freekassa\Success;
use app\models\Invoices;
use yii\helpers\Url;

class FreekassaController extends Controller{
    public $secret_key = 'w8vnim6b';
    public $merchant_id = 102834;

    public function actionResult(){
        if(Yii::$app->request->isGet){

            $sign = md5($this->merchant_id.':'.$_REQUEST['AMOUNT'].':'.$this->secret_key.':'.$_REQUEST['MERCHANT_ORDER_ID']);

            if ($sign != $_REQUEST['SIGN']) {
                die('wrong sign');
            }

            if(count(Invoices::find()->where(['transaction' => $_REQUEST['intid']])->all()) == null){
                $invoice = new Invoices();
                $invoice->transaction = $_REQUEST['intid'];
                $invoice->date = new \yii\db\Expression('NOW()');
                $invoice->account = $_REQUEST['MERCHANT_ORDER_ID'];
                $invoice->amount = $_REQUEST['AMOUNT'];
                $invoice->save();
            }


            //return Yii::$app->response->refresh();
            //return Yii::$app->session->setFlash('error', Yii::t('language', 'У вас недостаточно бонусов!'));
            die('YES');
        }else{
            return Yii::$app->response->redirect(Url::to('/dashboard'));
        }
    }

    public function actionSuccess(){
        if(Yii::$app->request->isGet){
            $invoice = Invoices::find()->where(['transaction' => $_REQUEST['intid']])->one();
            if($invoice->status == 'unpaid'){
                $invoice->status = 'paid';
                $invoice->amount = $_REQUEST['AMOUNT'];
                $invoice->update();
                $userData = Cabinet::find()->where(['email' => $_REQUEST['MERCHANT_ORDER_ID']])->one();
                $userData->balance = $userData->balance + $_REQUEST['AMOUNT'];
                if($userData->achPayment == 'false'){
                    $userData->achPayment = 'true';
                    $userData->bonuses = $userData->bonuses + 2;
                }
                if($userData->achPaymentPro == 'false'){
                    if($_REQUEST['AMOUNT'] >= 1000){
                        $userData->achPaymentPro = 'true';
                        $userData->bonuses = $userData->bonuses + 10;
                    }
                }
                $userData->update();
                return Yii::$app->response->redirect(Url::to('/cabinet/pay'));
            }else{
                return Yii::$app->response->redirect(Url::to('/dashboard'));
            }
        }else{
            return Yii::$app->response->redirect(Url::to('/dashboard'));
        }
    }
}
