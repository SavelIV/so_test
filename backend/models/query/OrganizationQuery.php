<?php

namespace backend\models\query;

use backend\models\Organization;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\backend\models\Organization]].
 *
 * @see \backend\models\Organization
 */
class OrganizationQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Organization[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Organization|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
