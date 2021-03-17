<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;
use app\models\cabinet\Login;
use app\models\cabinet\Register;
use app\models\cabinet\Edit;
use app\models\cabinet\Pay;
use app\models\cabinet\PayoutMoney;
use app\models\cabinet\items\AddItem;
use app\models\freekassa\GeneratePayment;
use app\models\Invoices;
use app\models\Payouts;
use app\models\Cabinet;
use app\models\Items;
use app\models\Rating;
use app\models\UploadForm;
use yii\web\UploadedFile;

class CabinetController extends Controller{

    public function actionItemsinfo($id){
        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }
        $item = Items::find()->where(['id' => $id])->one();
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        if($userData->admin == "false"){
            if($item->account != $userData->email){
                return Yii::$app->response->redirect(Url::to('/index'));
            }
        }

        $this->view->title = 'Информация о товаре '.$item->name;
        return $this->render('items/info', ['item' => $item]);
    }

    public function actionAdd(){
        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }
        $this->view->title = 'Новый товар';

        $model = new AddItem();
        if($model->load(Yii::$app->request->post())){
            $model->item = UploadedFile::getInstance($model, 'item');
            $model->img1 = UploadedFile::getInstance($model, 'img1');
            $model->img2 = UploadedFile::getInstance($model, 'img2');
            $model->img3 = UploadedFile::getInstance($model, 'img3');
            $model->img4 = UploadedFile::getInstance($model, 'img4');
            $model->img5 = UploadedFile::getInstance($model, 'img5');
            $model->AddItem();
        }

        return $this->render('items/add', ['model' => $model]);
    }


    public function actionDocs(){
        $this->view->title = 'Помощь';
        return $this->render('docs');
    }


    public function actionIndex(){
        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }

        $model = new Edit();
        if($model->load(Yii::$app->request->post())){
            $model->changePassword();
        }


        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $rating = Rating::find()->where(['account' => Yii::$app->session['email']])->all();
        $this->view->title = 'Профиль';
        return $this->render('index', ['model' => $model, 'userData' => $userData, 'rating' => $rating]);
    }

    public function actionPay(){
        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }
        $this->view->title = 'Пополнение баланса';


        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $invoices = Invoices::find()->where(['account' => Yii::$app->session['email']])->orderBy(['id' => SORT_DESC])->all();

        $model = new Pay();
        if($model->load(Yii::$app->request->post())){
            $result = $model->transferBonuses();
        }

        $modelPayment = new GeneratePayment();
        if($modelPayment->load(Yii::$app->request->post())){
            $result = $modelPayment->GeneratePayment();
        }

        return $this->render('pay', ['model' => $model, 'result' => $result, 'userData' => $userData, 'modelPayment' => $modelPayment, 'invoices' => $invoices]);
    }

    public function actionPayout(){
        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }
        $this->view->title = 'Вывод средств';


        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $payouts = Payouts::find()->where(['account' => Yii::$app->session['email']])->orderBy(['id' => SORT_DESC])->limit(5)->all();

        $modelPayout = new PayoutMoney();
        if($modelPayout->load(Yii::$app->request->post())){
            $modelPayout->Payout();
        }



        return $this->render('payout', ['modelPayout' => $modelPayout, 'payouts' => $payouts, 'userData' => $userData]);
    }

    public function actionLogin(){
        $this->layout = "auth";
        $this->view->title = 'MC-Market: Авторизация';
        if(isset(Yii::$app->session['email'])){
            return Yii::$app->response->redirect(Url::to('/index'));
        }
        $model = new Login();
        if($model->load(Yii::$app->request->post())){
            $model->userLogin();
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionRegister(){
        $this->layout = "auth";
        $this->view->title = 'MC-Market: Регистрация';
        if(isset(Yii::$app->session['email'])){
            return Yii::$app->response->redirect(Url::to('/index'));
        }
        $model = new Register();
        if($model->load(Yii::$app->request->post())){
            $model->userRegister();
        }
        return $this->render('register', ['model' => $model]);
    }

    public function actionRecovery(){
        $this->layout = "auth";
        $this->view->title = 'MC-Market: Восстановление пароля';
        return $this->render('recovery');
    }

    public function actionLogout(){
        if(isset(Yii::$app->session['email'])){
            $session = Yii::$app->session;
            if(isset(Yii::$app->session['admin'])){
                $session->remove('admin');
                $session->remove('admin');
                unset($session['admin']);
                unset($_SESSION['admin']);
            }
            $session->remove('email');
            unset($session['email']);
            unset($_SESSION['email']);
            $session->close();
            $session->destroy();
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }else{
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }
    }
}
