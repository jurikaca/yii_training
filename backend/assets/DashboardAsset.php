<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bootstrap/dist/css/bootstrap.min.css',
        'font-awesome/css/font-awesome.min.css',
        'Ionicons/css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'skins/_all-skins.min.css',
        'morris.js/morris.css',
        'jvectormap/jquery-jvectormap.css',
        'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        'bootstrap-daterangepicker/daterangepicker.css',
        'bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js',
        'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ];
    public $js = [
        'js/main.js',
        'jquery/dist/jquery.min.js',
        'jquery-ui/jquery-ui.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'raphael/raphael.min.js',
        'morris.js/morris.min.js',
        'jquery-sparkline/dist/jquery.sparkline.min.js',
        'jvectormap/jquery-jvectormap-1.2.2.min.js',
        'jvectormap/jquery-jvectormap-world-mill-en.js',
        'jquery-knob/dist/jquery.knob.min.js',
        'moment/min/moment.min.js',
        'bootstrap-daterangepicker/daterangepicker.js',
        'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'jquery-slimscroll/jquery.slimscroll.min.js',
        'js/adminlte.min.js',
        'js/dashboard.js',
        'js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
