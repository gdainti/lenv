<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sketch".
 *
 * @property integer $sketch_id
 * @property string $image
 * @property string $canvas
 * @property string $password
 */
class Sketch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sketch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'canvas', 'password'], 'required'],
            [['password'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sketch_id' => 'Sketch ID',
            'image' => 'Image',
            'password' => 'Password',
        ];
    }

    public function beforeSave() {

        // save image from base64
        $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->image));
        $file_name = Yii::getAlias('@webroot') .'/uploads/user/';
        $image_name = substr(uniqid(rand(1,6)), 0, 8).'.png';
        $file = $file_name . $image_name;
        file_put_contents($file, $image_data);
        $this->image = $image_name;

        // encode pass
        $this->password = md5($this->password);
        return true;
    }
}
