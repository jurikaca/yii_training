<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property string $id
 * @property string $todo_name
 * @property integer $status
 * @property string $created_time
 */
class Todo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_time'], 'safe'],
            [['todo_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'todo_name' => 'Todo Name',
            'status' => 'Status',
            'created_time' => 'Created Time',
        ];
    }
}
