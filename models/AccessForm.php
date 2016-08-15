<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AccessForm extends Model
{
    public $password;
    public $sketch_id;

    public function rules()
    {
        return [
            [['password'], 'required', 'message' => 'Enter password to edit sketch'],
            [['password'], 'string', 'max' => 50],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        $sketch = Sketch::findOne($this->sketch_id);
        if ($sketch->password != md5($this->password)) {
            $this->addError($attribute, 'Wrong password');
        }
    }
}
