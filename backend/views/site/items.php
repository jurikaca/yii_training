<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \fruppel\googlecharts\GoogleCharts;

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=$totals['total_items'];?></h3>

                    <p>Total Items</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <?= GoogleCharts::widget([
                'id' => 'my-id',
                'visualization' => 'PieChart',
                'data' => [
                    'cols' => [
                        [
                            'id' => 'type',
                            'label' => 'Type',
                            'type' => 'string'
                        ],
                        [
                            'id' => 'items',
                            'label' => 'Items',
                            'type' => 'number'
                        ]
                    ],
                    'rows' => $pie_data
                ],
                'options' => [
                    'title' => 'Number of items per type',
                    'width' => '100%',
                    'height' => 150,
                    'is3D' => true,
                ],
                'responsive' => true,
            ]) ?>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=$totals['avarage_price'];?><sup style="font-size: 20px">$</sup></h3>

                    <p>Avarage Price</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <h1>5 latest items</h1>
    <div class="container">
        <div class="items-index">
            <div class = "col-md-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute'     =>  'vendor_id',
                            'value'         =>  'vendor.name'
                        ],
                        [
                            'attribute'     =>  'Vendor Logo',
                            'value'         =>  'vendor.logo'
                        ],
                        'photo',
                        'item_name',
                        'price',
                        'tags',
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</section>