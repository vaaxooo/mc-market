<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'assets/vendors/iconfonts/mdi/css/materialdesignicons.css',
		'assets/vendors/iconfonts/font-awesome/css/font-awesome.css',
		'assets/css/shared/style.css',
		'assets/css/demo_1/style.css',
		'asssets/images/favicon.ico',
		'assets/vendors/css/vendor.addons.css',
		'http://alexgorbatchev.com/pub/sh/current/styles/shCore.css',
		'http://alexgorbatchev.com/pub/sh/current/styles/shThemeDefault.css',
    ];
    public $js = [
		'assets/vendors/js/core.js',
		'assets/vendors/apexcharts/apexcharts.min.js',
		'assets/vendors/chartjs/Chart.min.js',
		'assets/js/charts/chartjs.addon.js',
		'assets/js/template.js',
		'assets/js/dashboard.js',
		'http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js',
		'http://alexgorbatchev.com/pub/sh/current/scripts/shBrushPhp.js',
    ];
    public $depends = [

    ];
}
