<?php

namespace backend\components;

use Yii;
use yii\base\Component;

class CheckIfLoggedIn extends \yii\base\Behavior
{

    public function events(){
        return [
            // event when before request
            \yii\web\Application::EVENT_BEFORE_REQUEST => 'changeLanguage',
        ];
    }

    public function checkIfLoggedIn(){
        if(Yii::$app->user->isGuest){ // return to login page
            // echo 'u are a guest';
        }else{ // the user is logged in
            // echo 'u are logged in';
        }
        die();
    }

    // change language
    public function changeLanguage(){
        if(\Yii::$app->getRequest()->getCookies()->getValue('lang')){
            \Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }
}