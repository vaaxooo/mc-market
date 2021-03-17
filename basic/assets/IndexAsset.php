<?php

namespace app\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		"main-assets/css/sfuidisplay.css",
		"main-assets/css/all.css",
		"main-assets/css/plugins.min.css",
		"main-assets/css/app.css",
		"main-assets/css/custom.css",
    ];
    public $js = [
		'main-assets/js/plugins.min.js',
		'main-assets/js/app.js',
    ];
    public $depends = [

    ];
}
