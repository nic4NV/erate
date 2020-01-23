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
    const RUB_ABR = 'rub';
    const DB_RATIO = 10000;
    const PRECISION = 4;
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

    /**
     * @param string $pair
     * @return array|void
     */
    private function getPartsOfPair(string $pair) {
        $parts = str_split(strtolower($pair), 3);
        if(
            count($parts) == 2 &&
            $parts[0] !== $parts[1] &&
            ($parts[0] == self::RUB_ABR || isset($this->{$parts[0]})) &&
            ($parts[1] == self::RUB_ABR || isset($this->{$parts[1]}))
        )
            return $parts;
        else
            return;
    }

    /**
     * @param string $pair
     * @return bool|float
     */
    public function getRate(string $pair) {
        if($parts = $this->getPartsOfPair($pair)) {
            if($parts[0] == self::RUB_ABR) // rub/eur
                $rate = self::DB_RATIO / $this->{$parts[1]};
            elseif($parts[1] == self::RUB_ABR) // usd/rub
                $rate = $this->{$parts[0]} / self::DB_RATIO;
            else $rate = $this->{$parts[0]} / $this->{$parts[1]};

            return isset($rate) ? round($rate, self::PRECISION) : false;
        }
        return;
    }

    public static function buildDynamic(array $models, string $pair): array {
        $dynamic = [];
        foreach($models as $num=>$model) {
            if($num == 0) {
                $dynamic[$num]['rate'] = $model->getRate($pair);
            } else {
                $dynamic[$num]['rate'] = $model->getRate($pair);
                $dynamic[$num]['changing'] = round($dynamic[$num]['rate'] - $dynamic[$num - 1]['rate'], self::PRECISION);
            }
        }
        return $dynamic;
    }
}
