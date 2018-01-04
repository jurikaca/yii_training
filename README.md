# Yii2 test app (Inventory App)

Follow the steps below to deploy this yii2 app:

##### 1. Download all code from github

git repo: `https://github.com/jurikaca/yii_training.git` , branch: `inventory_app`

##### 2. Install all the dependencies

Run `composer install` to install all the dependencies

##### 3. Change base url on frontend and backend

Find the config file on backend/config/main.php and change the url as your local url:

` 'urlManagerFrontend' => [

             'class' => 'yii\web\urlManager',
             
             'enablePrettyUrl' => true,
             
             'showScriptName' => false,
             
             'baseUrl' => 'http://localhost:8080/inventory_app/frontend/web/index.php',
             
         ]`


Find the config file on frontend/config/main.php and change the url as your local url:

`'urlManagerBackend' => [

             'class' => 'yii\web\urlManager',
             
             'enablePrettyUrl' => true,
             
             'showScriptName' => false,
             
             'baseUrl' => 'http://localhost:8080/inventory_app/backend/web/index.php',
             
         ],`

##### 4. Set database configs

Find and change the db config file on common/config/main-local.php