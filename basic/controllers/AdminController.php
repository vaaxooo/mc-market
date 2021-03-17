<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;
use yii\data\Pagination;
use app\models\Cabinet;
use app\models\Settings;
use app\models\Items;
use app\models\Promocodes;
use app\models\support\SendMessage;
use app\models\admin\CreatePromocode;

class AdminController extends Controller{

    public function actionUsers(){
        $this->view->title = "Пользователи";
        if (!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        $users = Cabinet::find();
        $countUsers = clone $users;
        $pages = new Pagination(['totalCount' => $countUsers->count(), 'pageSize' => 15]);
        $pages->pageSizeParam = false;
        $usersList = $users->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('users', ['usersList' => $usersList, 'pages' => $pages]);
    }

    public function actionItems(){
        $this->view->title = "Товары ожидают проверки";
        if (!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        $items = Items::find()->where(['verified' => 'false']);
        $countitems = clone $items;
        $pages = new Pagination(['totalCount' => $countitems->count(), 'pageSize' => 15]);
        $pages->pageSizeParam = false;
        $items = $items->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('items', ['items' => $items, 'pages' => $pages]);
    }

    public function actionPromocodes(){
        $this->view->title = "Minecraft Hosting :: Promocodes";
        if (!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        $promocodes = Promocodes::find()->all();
        $model = new CreatePromocode();

        if($model->load(Yii::$app->request->post())){
            $model->CreatePromocode();
        }

        return $this->render('promocodes', ['model' => $model, 'promocodes' => $promocodes]);
    }

    public function actionDeletepromocode($id){
        if(!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }

        $promocode = Promocodes::find()->where(['id' => $id])->one();
        if($promocode != null){
            $promocode->delete();
            return Yii::$app->response->redirect(Url::to('/admin/promocodes'));
        }else{
            return Yii::$app->response->redirect(Url::to('/admin/promocodes'));
        }
    }

    public function actionItemsactivate($id){
        if(!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }

        $items = Items::find()->where(['id' => $id])->one();
        $items->verified = "true";
        $items->update();
        return Yii::$app->response->redirect(Url::to('/admin/items'));
    }

    public function actionItemsremove($id){
        if(!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }

        $items = Items::find()->where(['id' => $id])->one();
        $items->delete();
        return Yii::$app->response->redirect(Url::to('/admin/items'));
    }

    public function actionBanned($id){
        if(!isset(Yii::$app->session['admin'])) {
            return Yii::$app->response->redirect(Url::to('/index'));
        }

        if (!isset(Yii::$app->session['email'])) {
            return Yii::$app->response->redirect(Url::to('/cabinet/login'));
        }

        $userData = Cabinet::find()->where(['id' => $id])->one();
        if($userData->type == "unbanned"){
            $userData->type = "banned";
        }else{
            $userData->type = "unbanned";
        }
        $userData->update();
        return Yii::$app->response->redirect(Url::to('/admin/users'));
    }


}
