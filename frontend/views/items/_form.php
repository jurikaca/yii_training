<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Vendors;
use common\models\Types;
use dosamigos\datepicker\DatePicker;
?>

<div class="items-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_id')->dropDownList(
        ArrayHelper::map(Vendors::find()->all(),'id','name'),
        ['prompt' => 'Select vendor...']
    ) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(Types::find()->all(),'id','name'),
        ['prompt' => 'Select type...']
    ) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?php // echo  $form->field($model, 'release_date')->textInput() ?>

    <?= $form->field($model, 'release_date')->widget(DatePicker::className(), [
        'attribute' => 'release_date',
        'model' => $model,
        'template' => '{addon}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'viewFormat' => 'dd-M-yyyy',
        ]
    ])->label('Release Date');?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
