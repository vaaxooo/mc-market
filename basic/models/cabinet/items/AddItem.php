<?php

namespace app\models\cabinet\items;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use app\models\Payouts;
use app\models\Notifications;
use app\models\Items;
use yii\helpers\Url;
use yii\web\UploadedFile;

class AddItem extends Model{
    public $name, $version, $small_description, $description, $tags, $price, $game, $category;
    public $img1, $img2, $img3, $img4, $img5, $item;

    public function rules(){
        return [
            [['name', 'version', 'small_description', 'description', 'tags', 'price', 'game', 'category', 'img1', 'img2', 'item'], 'required'],
            [['small_description'], 'string', 'length' => [10, 55]],
            [['description'], 'string', 'length' => [40, 5000]],
            [['price'], 'integer'],
            [['img1', 'img2', 'img3', 'img4', 'img5'], 'file'],
            [['item'], 'file', 'skipOnEmpty' => true, 'extensions' => 'zip, phar, rar'],
        ];
    }

    public function sendNotification(){
        $notification = new Notifications();
        $notification->title = "Проверка товара";
        $notification->message = "Ваш товар отправлен на проверку!";
        $notification->date = new \yii\db\Expression('NOW()');
        $notification->account = Yii::$app->session['email'];
        $notification->save();
    }

    public function AddItem(){
        if($this->validate()){
            $userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
            $item = new Items();
            $item->name = $this->name;
            $item->version = $this->version;
            $item->small_description = $this->small_description;
            $item->description = $this->description;
            $item->tags = $this->tags;
            $item->price = $this->price;
            $item->game = $this->game;
            $item->category = $this->category;
            $this->img1->saveAs('uploads/' . $this->img1->baseName . '.' . $this->img1->extension);
            $item->image1 = 'web/uploads/'.$this->img1->baseName.'.'.$this->img1->extension;
            $this->img2->saveAs('uploads/'.$this->img2->baseName.'.'.$this->img2->extension);
            $item->image2 = 'web/uploads/'.$this->img2->baseName.'.'.$this->img2->extension;
            $this->item->saveAs('items/'.$this->item->baseName.'.'.$this->item->extension);
            $item->download_link = 'web/items/'.$this->item->baseName.'.'.$this->item->extension;
            if($this->img3 != null){
                $this->img3->saveAs('uploads/' . $this->img3->baseName . '.' . $this->img3->extension);
                $item->image3 = 'web/uploads/' . $this->img3->baseName . '.' . $this->img3->extension;
            }
            if($this->img4 != null){
                $this->img4->saveAs('uploads/' . $this->img4->baseName . '.' . $this->img4->extension);
                $item->image4 = 'web/uploads/' . $this->img4->baseName . '.' . $this->img4->extension;
            }
            if($this->img5 != null){
                $this->img5->saveAs('uploads/' . $this->img5->baseName . '.' . $this->img5->extension);
                $item->image5 = 'web/uploads/' . $this->img5->baseName . '.' . $this->img5->extension;
            }
            $item->date = new \yii\db\Expression('NOW()');
            $item->account = Yii::$app->session['email'];
            $item->save();
            $this->sendNotification();
            return Yii::$app->response->redirect(Url::to('/index'));
        }else{
            return false;
        }
    }
}

?>