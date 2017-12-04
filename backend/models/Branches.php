<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property string $branch_id
 * @property string $companies_company_id
 * @property string $branch_name
 * @property string $branch_address
 * @property string $branch_created_date
 * @property string $branch_status
 *
 * @property Companies $companiesCompany
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companies_company_id'], 'required'],
            [['companies_company_id'], 'integer'],
            [['branch_created_date'], 'safe'],
            [['branch_status'], 'string'],
            [['branch_name'], 'string', 'max' => 64],
            ['branch_name','unique'],
            ['branch_status','required','when' => function($model){
                return (!empty($model->branch_address) ? true : false); // server side validation, if address is empty the make status required (conditional validation)
            }, 'whenClient' => // the validation on client side
                "function(){
                    if($('#branch_address').val() === 'undefined'){
                        false;
                    }else{
                        true;
                    }
            }"],
            [['branch_address'], 'string', 'max' => 255],
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'companies_company_id' => 'Company Name',
            'branch_name' => 'Branch Name',
            'branch_address' => 'Branch Address',
            'branch_created_date' => 'Branch Created Date',
            'branch_status' => 'Branch Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesCompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'companies_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['branches_branch_id' => 'branch_id']);
    }
}
