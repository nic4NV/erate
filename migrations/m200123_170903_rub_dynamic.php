<?php

use yii\db\Migration;

/**
 * Class m200123_170903_rub_dynamic
 */
class m200123_170903_rub_dynamic extends Migration
{
    private $testData = [
        ["2020-01-14",678975,610600,5421730000,629115],
        ["2020-01-15",682625,612725,5409730000,626386],
        ["2020-01-16",683700,614450,5375740000,633265],
        ["2020-01-17",685250,614175,5481180000,635293],
        ["2020-01-18",686700,616625,5496850000,639284],
        ["2020-01-19",682625,615550,5352430000,637189],
        ["2020-01-20",683300,615475,5319410000,634776],
        ["2020-01-21",686200,618825,5407490000,639000],
        ["2020-01-22",685975,618425,5359370000,636614],
        ["2020-01-23",684875,620700,5164390000,639797]
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rub_dynamic', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'eur' => 'bigint NOT NULL',
            'usd' => 'bigint NOT NULL',
            'btc' => 'bigint NOT NULL',
            'chf' => 'bigint NOT NULL'
        ]);

        $this->batchInsert('rub_dynamic', ['date', 'eur', 'usd', 'btc', 'chf'], $this->testData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rub_dynamic');
    }
}


