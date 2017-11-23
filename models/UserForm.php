<?php

namespace app\models;

use yii\base\Model;

class UserForm extends Model
{
    public $name;
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email are required
            [['name', 'email'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

}
