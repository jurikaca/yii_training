<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property string $location_id
 * @property string $zip_code
 * @property string $city
 * @property string $province
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip_code', 'city'], 'string', 'max' => 64],
            [['province'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
