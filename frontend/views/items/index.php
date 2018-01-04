<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="container">
    <div class="items-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class = "col-md-3">
            <h3 style="text-align: center;">Latest Items</h3>
            <!-- here list 3 latest items-->
            <ul class="list-group">
                <?php foreach($latest_items as $item){ ?>
                    <li class="list-group-item"><?=$item['item_name'];?></li>
                <?php } ?>
            </ul>
        </div>
        <div class = "col-md-9">
            <p>
                <?= Html::a('Create Items', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'item_name',
                [
                    'attribute'     =>  'vendor_id',
                    'value'         =>  'vendor.name'
                ],
                [
                    'attribute'     =>  'type_id',
                    'value'         =>  'type.name',
                ],
                'serial_number',
                'price',
                'color',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>
</div>
