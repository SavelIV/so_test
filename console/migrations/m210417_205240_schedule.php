<?php

use yii\db\Migration;

/**
 * Class m210417_205240_schedule
 */
class m210417_205240_schedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = $this->db->getDriverName() == 'mysql' ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%schedule}}',
            [
                'id' => $this->primaryKey(),
                'organization_id' => $this->integer()->null(),
                'day_of_week' => $this->string()->notNull()->defaultValue(''),
                'open' => $this->string()->null()->defaultValue(null),
                'close' => $this->string()->null()->defaultValue(null),
            ],
            $options
        );

        $this->addForeignKey(
            'fk-schedule-organization_id-organization-id',
            '{{%schedule}}',
            'organization_id',
            '{{%organization}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-schedule-organization_id-organization-id', '{{%schedule}}');
        $this->dropTable('{{%schedule}}');
    }
}
