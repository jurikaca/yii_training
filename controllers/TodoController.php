<?php
// This is a REST controller

namespace app\controllers;

use yii\rest\ActiveController;

class TodoController extends ActiveController
{
    public $modelClass = 'app\models\Todo';

    public function actions(){
        // here defining action create, override action create
        // if we dont put this function then the default function create of ActiveController will be used
        $actions = parent::actions(); // get default actions from parent controller
        unset($actions['create']);// unset the default create action
        return $actions; // return the actions after removing default create action
    }

    /**
     * this function saves a todo record on db, the request comes from outside
     *
     * @return Todo
     */
    public function actionCreate(){
        $model = new Todo();

        $model->load(Yii::$app->request->post(), '');
        $model->status = 1;
        $model->save();
        return $model;
    }
}