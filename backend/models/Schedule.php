<?php

namespace backend\models;

use backend\models\query\OrganizationQuery;
use backend\models\query\ScheduleQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int|null $organization_id
 * @property string $day_of_week
 * @property string|null $open
 * @property string|null $close
 *
 * @property Organization $organization
 */
class Schedule extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organization_id'], 'integer'],
            [['open', 'close'], 'safe'],
            [['day_of_week'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::class, 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organization_id' => 'Организация',
            'day_of_week' => 'День недели',
            'open' => 'Открыто с:',
            'close' => 'Закрыто с:',
        ];
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return ActiveQuery|OrganizationQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::class, ['id' => 'organization_id']);
    }

    /**
     * @return string
     */
    public static function getWeekDayRus()
    {
        $days = array(
            'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
            'Четверг', 'Пятница', 'Суббота'
        );
        return $days[(date('w'))];
    }

    /**
     * @return string[]
     */
    public static function getDaysOfWeek(): array
    {
        return [
            '0' => 'Воскресенье',
            '1' => 'Понедельник',
            '2' => 'Вторник',
            '3' => 'Среда',
            '4' => 'Четверг',
            '5' => 'Пятница',
            '6' => 'Суббота',
        ];
    }

    /**
     * @return string|null
     * @throws \Exception
     */
    public function getDayOfWeek(): ?string
    {
        return ArrayHelper::getValue(static::getDaysOfWeek(), $this->day_of_week);
    }

    /**
     * @return string|null
     * @throws \Exception
     */
    public function getTimeToClose(): ?string
    {
        $timeToClose = date_diff((new \DateTime(date('H:i'))), (new \DateTime($this->close)), $absolute = true);
        return 'часов: ' . $timeToClose->h . ', минут: ' . $timeToClose->i;
    }

    /**
     * @return string|null
     * @throws \Exception
     */
    public function getTimeToOpen(): ?string
    {
        $timeToOpen = date_diff((new \DateTime($this->open)), (new \DateTime(date('H:i'))), $absolute = true);
        return 'часов: ' . $timeToOpen->h . ', минут: ' . $timeToOpen->i;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function getIsOpenNow(): ?bool
    {
        return $this->day_of_week == date('w') && $this->open <= date('H:i') && $this->close >= date('H:i');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function getIsClosedNow(): ?bool
    {
        return $this->day_of_week !== date('w') || ($this->day_of_week == date('w') && $this->open >= date('H:i'));
    }

    /**
     * @return array|Organization[]
     */
    public static function getOpenTodayOrganisationsList()
    {
        return Organization::find()->innerJoin(
            Schedule::tableName(),
            new Expression(
                Schedule::tableName() . '.[[day_of_week]] = ' . date('w')) . ' AND ' .
            Schedule::tableName() . '.[[organization_id]] = ' . Organization::tableName() . '.[[id]]'
        )->indexBy('id')->column();
    }

    /**
     * @return array|Organization[]
     */
    public static function getClosedTodayOrganisationsSchedule()
    {
        return Schedule::find()->where([
            'IN', Schedule::tableName() . '.[[organization_id]]', Schedule::getClosedTodayOrganisationsList()
        ])->all();
    }


    /**
     * @return array|Organization[]
     */
    public static function getClosedTodayOrganisationsList()
    {
        $openOrganizationsList = Schedule::getOpenTodayOrganisationsList();

        return Organization::find()->where([
            'NOT IN', Organization::tableName() . '.[[id]]', $openOrganizationsList
        ])->indexBy('id')->column();
    }


    /**
     * {@inheritdoc}
     * @return ScheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScheduleQuery(get_called_class());
    }
}
