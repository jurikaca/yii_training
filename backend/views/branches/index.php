<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <?php
    // the variable settled here can be used on the layout view
    // $this->params['data'] = 'this is a string created on the view file, and printed on layout view';
    // we can use $this->blocks for big amount of data
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Branches', ['value' => Url::to('index.php?r=branches/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Branches</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);

        echo "<div id = 'modalContent'></div>";

        Modal::end();
    ?>

    <?php
    $gridColumns = [
        'id',
        'branch_name',
        'branch_address',
        'branch_created_date',
        'branch_status',
    ];

    echo ExportMenu::widget([
        'dataProvider'  =>  $dataProvider,
        'columns'       =>  $gridColumns
    ]);

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'export' => false,
        'rowOptions' => function($model){
            if($model->branch_status == 'inactive'){
                return ['class' => 'danger'];
            }else{
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'     =>  'companies_company_id',
                'value'         =>  'companiesCompany.company_name'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'header' => 'BRANCH',
                'attribute' => 'branch_name'
            ],
            'branch_address',
            'branch_created_date',
            // 'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
