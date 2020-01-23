<?php

namespace app\models;

use yii\validators\DateValidator;

/**
 * This is the model class for table "rub_dynamic".
 *
 * @property int id
 * @property int $eur
 * @property int $usd
 * @property int $btc
 * @property int $chf
 * @property DateValidator::TYPE_DATE $date
 */
class RubDynamic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rub_dynamic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date', 'eur', 'usd', 'btc', 'chf'], 'required'],
            [['id', 'eur', 'usd', 'btc', 'chf'], 'integer'],
            [['date'], DateValidator::TYPE_DATE]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'date' => 'date',
            'eur' => 'eur',
            'usd' => 'usd',
            'btc' => 'btc',
            'chf' => 'chf'
        ];
    }
}
