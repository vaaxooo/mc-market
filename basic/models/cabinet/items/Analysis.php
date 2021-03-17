<?php

namespace app\models\cabinet\items;

use Yii;
use yii\base\Model;
use app\models\Cabinet;
use yii\helpers\Url;
use app\models\Items;
use yii\web\UploadedFile;

class Analysis extends Model{
    public $item, $captcha;

    public function rules(){
        return [
            [['item', 'captcha'], 'required'],
            [['captcha'], 'captcha'],
            [['item'], 'file', 'skipOnEmpty' => true, 'extensions' => 'php, phar'],
        ];
    }

    public function Analysis(){
        if($this->validate()){
            $this->item->saveAs('analysis/'.$this->item->baseName.'.'.$this->item->extension);
            $file_content = @file_get_contents('analysis/'.$this->item->baseName.'.'.$this->item->extension);
            $bad_codes = [
                'file_get_contents',
                'addOp',
                'setOp',
                'Мы переезжаем',
                'Мы переехали',
                'transfer',
            ];

            foreach($bad_codes as $code){
                if (strpos($file_content, $code) !== false) {
                    return Yii::$app->session->setFlash('error', 'Найдены совпадения с вредоносным кодом!');
                }else{
                    return Yii::$app->session->setFlash('success', 'Совпадений с вредоносным кодом ненайдено!');
                }
            }
        }else{
            return false;
        }
    }
}

?>