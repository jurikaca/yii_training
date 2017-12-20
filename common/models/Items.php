<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property string $id
 * @property string $item_name
 * @property string $vendor_id
 * @property string $type_id
 * @property string $serial_number
 * @property string $price
 * @property string $weight
 * @property string $color
 * @property string $release_date
 * @property string $photo
 * @property string $tags
 * @property string $created_date
 *
 * @property Vendors $vendor
 * @property Types $type
 */
class Items extends \yii\db\ActiveRecord
{

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendor_id', 'type_id'], 'required'],
            [['vendor_id', 'type_id'], 'integer'],
            [['price', 'weight'], 'number'],
            [['release_date', 'created_date'], 'safe'],
            [['item_name', 'serial_number', 'tags', 'photo'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 64],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendors::className(), 'targetAttribute' => ['vendor_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Item Name',
            'vendor_id' => 'Vendor Name',
            'type_id' => 'Type Name',
            'serial_number' => 'Serial Number',
            'price' => 'Price',
            'weight' => 'Weight',
            'color' => 'Color',
            'release_date' => 'Release Date',
            'imageFile' => 'Photo',
            'tags' => 'Tags',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendors::className(), ['id' => 'vendor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::className(), ['id' => 'type_id']);
    }

    /*
     * function to return total number of items and average price for all items
     */
    public function getTotals(){
        $sql1 = "
            SELECT
                IFNULL(COUNT(*),0) AS total_items,
                format(AVG(price), 2) AS avarage_price
            FROM
                items
        ";
        return Yii::$app->getDb()->createCommand($sql1)
            ->queryOne();
    }

    /*
     * function to return total number of items per type
     */
    public function getItemsPerType(){
        $sql = "
            SELECT
                types.id, types.name as type_name, IFNULL(items.num_items, 0) AS num_items
            FROM types
            LEFT JOIN (
                SELECT
                    COUNT(items.ID) AS num_items, items.type_id
                FROM
                    items
                GROUP BY items.type_id
            ) AS items ON items.type_id = types.id
        ";
        return Yii::$app->getDb()->createCommand($sql)
            ->queryAll();
    }

    /**
     * function to generate pie chart object based on input values
     *
     * @param $items, items array
     * @return array, pie chart array
     */
    public function generatePieObject($items){
        $data = [];
        foreach($items as $item){
            $data[] = [
                'c' => [
                    ['v' => $item['type_name']],
                    ['v' => (int) $item['num_items']]
                ],
            ];
        }
        return $data;
    }


}
