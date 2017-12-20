<?php
namespace backend\controllers;

use Yii;
use common\models\Items;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','items','users'],
                        'allow' => true,
                        'roles' => ['@'], // allow only authenticated users to access the following listed actions
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // the comments below are examples of using a component
        //$lkrValue = Yii::$app->MyComponent->currencyConvert('USD' , 'EUR' , 100);
        //print_r($lkrValue);
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'loginLayout'; // loading another layout for login page 'backend/views/layouts/loginLayout'

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionItems(){
        $model = new Items();
        $dataProvider = new ActiveDataProvider([
            'query' => Items::find()
                ->limit(5),
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'created_date' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('items',array(
            'totals'            =>  $model->getTotals(),
            'pie_data'          =>  $model->generatePieObject($model->getItemsPerType()),
            'dataProvider'     =>  $dataProvider
        ));
    }

    public function actionUsers(){

        return $this->render('users',array(
        ));
    }
}
