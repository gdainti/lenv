<?php

use yii\db\Migration;

/**
 * Handles the creation for table `sketch`.
 */
class m160811_215645_create_sketch_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sketch', [
            'sketch_id' => $this->primaryKey(),
            'image' =>  $this->string()->notNull(),
            'canvas' =>  'MEDIUMTEXT NOT NULL',
            'password' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sketch');
    }
}
