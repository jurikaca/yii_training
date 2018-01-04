<?php
namespace backend\controllers;

use Yii;
use common\models\Items;
use yii\helpers\Json;
use common\models\User;
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
                        'actions' => ['logout', 'index','items','users','change_user_role','delete_user'],
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
            if(Yii::$app->user->identity->role == 'admin'){ // if user is admin
                return $this->goBack();
            }else{ // if user is not admin then redirect on the frontend
                return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(Yii::$app->urlManagerFrontend->baseUrl));
            }
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

        $model = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
                ->limit(5),
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('users',array(
            'dataProvider'     =>  $dataProvider
        ));
    }

    /**
     * function to change user role
     */
    public function actionChange_user_role(){
        $model = new User();
        $model = $model->findOne(Yii::$app->request->post('userId'));
        $new_role = Yii::$app->request->post('role');

        if($new_role == 'admin' || $new_role == 'guest'){
            $model->role = $new_role;
            if($model->save()){
                $result = ["status"=>"success", "msg" => 'Role successfully changed!'];
            }else{
                $result = ["status"=>"error", "msg" => 'An error occurred while saving user role! Please try again later.'];
            }
        }else{
            $result = ["status"=>"error", "msg" => 'The role given does not exist!'];
        }

        echo Json::encode($result); die;
    }

    /**
     * function to delete a user via ajax
     */
    public function actionDelete_user(){
        if(User::findOne(Yii::$app->request->post('userId'))->delete()){
            $result = ["status"=>"success", "msg" => 'User was successfully deleted!'];
        }else{
            $result = ["status"=>"error", "msg" => 'An error occurred while deleting user! Please try again later.'];
        }

        echo Json::encode($result); die;
    }
}
