<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Cabinet;
use app\models\Settings;
use app\models\Items;
use yii\helpers\Url;
use app\models\Rating;
use app\models\HistorySells;
use app\models\cabinet\AddRating;
use app\models\cabinet\items\BuyItem;
use app\models\cabinet\items\Analysis;
use yii\web\UploadedFile;
use yii\data\Pagination;

class SiteController extends Controller{


    public function actionDashboard(){
        $this->layout = "index";
        $this->view->title = "MC-Market: Торговая площадка Minecraft";

        return $this->render('dashboard');
    }

    public function actionIndex(){
        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }
        $this->view->title = "Главная страница";
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $historyTrade = HistorySells::find()->where(['account' => Yii::$app->session['email']])->all();

        $items = Items::find()->where(['account' => Yii::$app->session['email']])->orderBy(['id' => SORT_DESC]);
        $countItems = clone $items;
        $pages = new Pagination(['totalCount' => $countItems->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $items = $items->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['userData' => $userData, 'items' => $items, 'historyTrade' => $historyTrade, 'pages' => $pages]);
    }

    public function actionTrade(){
        $this->view->title = "Выберите раздел с нужной игрой";
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $items = Items::find()->where(['account' => Yii::$app->session['email']])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('trade', ['userData' => $userData, 'items' => $items]);
    }

    public function actionAnalysis(){

        $model = new Analysis();
        if($model->load(Yii::$app->request->post())){
            $model->item = UploadedFile::getInstance($model, 'item');
            $model->Analysis();
            $item = $model->item;
        }

        $this->view->title = "Анализ плагинов";
        return $this->render('analysis', ['model' => $model, 'item' => $item]);
    }

    public function actionView($id){

        $model = new BuyItem();
        if($model->load(Yii::$app->request->post())){
            $model->BuyItem($id);
        }

        $item = Items::find()->where(['id' => $id])->one();
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $history = count(HistorySells::find()->where(['itemId' => $id, 'email' => Yii::$app->session['email']])->all());
        $historyCount = count(HistorySells::find()->where(['itemId' => $id])->all());


        $this->view->title = 'Информация о товаре '.$item->name;
        return $this->render('mcpe/view', ['userData' => $userData, 'item' => $item, 'model' => $model, 'history' => $history, 'historyCount' => $historyCount]);
    }

    public function actionMcpcplugins(){

        $this->view->title = "Minecraft PC Плагины";
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $items = Items::find()->where(['game' => 'mcpc', 'category' => 'plugins'])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('mcpc/items', ['userData' => $userData, 'items' => $items]);
    }


    public function actionMcpcmaps(){

        $this->view->title = "Minecraft PC Карты";
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
        $items = Items::find()->where(['account' => Yii::$app->session['email']])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('mcpc/items', ['userData' => $userData, 'items' => $items]);
    }

    public function actionMcpeplugins(){

        $this->view->title = "Minecraft PE Плагины";
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();

        $items = Items::find()->where(['game' => 'mcpe', 'category' => 'plugins'])->orderBy(['id' => SORT_DESC]);
        $countItems = clone $items;
        $pages = new Pagination(['totalCount' => $countItems->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $items = $items->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('mcpe/items', ['userData' => $userData, 'items' => $items, 'pages' => $pages]);
    }

    public function actionMcpemaps(){

        $this->view->title = "Minecraft PE Карты";
        $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();

        $maps = Items::find()->where(['game' => 'mcpe', 'category' => 'maps'])->orderBy(['id' => SORT_DESC]);
        $countMaps = clone $maps;
        $pages = new Pagination(['totalCount' => $countMaps->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $maps = $maps->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('mcpe/maps', ['userData' => $userData, 'maps' => $maps, 'pages' => $pages]);
    }

    public function actionInfo($id){
        $userData = Cabinet::find()->where(['id' => $id])->one();
        $rating = Rating::find()->where(['account' => $userData->email])->all();
        $items = Items::find()->where(['account' => $userData->email])->all();
        $this->view->title = $userData->firstname.' '.$userData->lastname;


        $model = new AddRating();
        if($model->load(Yii::$app->request->post())){
            $model->AddRating($id);
        }

        return $this->render('info', ['userData' => $userData, 'rating' => $rating, 'items' => $items, 'model' => $model]);
    }

    public function actionApi(){
        $this->layout = "api";
        $response = 'Параметры неверно указанны!';
        if(Yii::$app->request->isGet){
            $request = Yii::$app->request->get();
            switch($request['params']){
                case 'items':
                    $response = Items::find()->all();
                break;
                case 'users':
                    $response = Cabinet::find()->all();
                    var_dump($response);
                break;
            }
        }else{
            return $response;
        }
    }

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
