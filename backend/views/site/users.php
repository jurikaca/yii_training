<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Users</h1>
<div class="container">
    <div class="items-index">
        <div class = "col-md-12">
            <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'email',
                    [
                        'label' => 'Role',
                        'value' => function($model){
                            return Html::activeDropDownList($model, 'role',
                                [
                                    'admin'    =>  'Admin',
                                    'guest'    =>  'guest',
                                ],
                                [
                                    'class' => 'form-control user_role_select',
                                    'data-userId'   =>  $model->id
                                ]
                            );
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Role',
                        'value' => function($model){
                            return Html::a('<i class="fa fa-trash"></i>',
                                null,
                                [
                                    'class' => 'btn btn-black delete_user_btn',
                                    'data-userId'   =>  $model->id,
                                ]
                            );
                        },
                        'format' => 'raw'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
<?php

$script = <<< JS

    /**
    *  change event function to save user role
    */
    $('.user_role_select').change(function(){
        var role = $(this).find('option:selected').val();
        var userId = $(this).attr('data-userId');
        $.post(
            'index.php?r=site/change_user_role',
            {
                userId  :   userId,
                role    :   role
            },
            function(result){
                result = JSON.parse(result);
                alert(result.msg);
        });
    });

    /**
    *  click event function to delete user
    */
    $('.delete_user_btn').click(function(){
        if(window.confirm("Are you sure delete this user ?")){
            var userId = $(this).attr('data-userId');
            $.post(
                'index.php?r=site/delete_user',
                {
                    userId  :   userId
                },
                function(result){
                    result = JSON.parse(result);
                    if(result.status == 'success'){
                        $.pjax({container: '#pjax-grid-view'});
                    }
                    alert(result.msg);
            });
        }
    });

JS;
$this->registerJs($script);
?>