<?php

namespace backend\models\query;

use backend\models\Schedule;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\backend\models\Schedule]].
 *
 * @see \backend\models\Schedule
 */
class ScheduleQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Schedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Schedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
