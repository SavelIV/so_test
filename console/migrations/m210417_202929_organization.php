<?php

use yii\db\Migration;

/**
 * Class m210417_202929_organization
 */
class m210417_202929_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = $this->db->getDriverName() == 'mysql' ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%organization}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull()->defaultValue(''),
            ],
            $options
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%organization}}');
    }
}
