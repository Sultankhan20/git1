<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m170801_121202_create_blog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('blog', [
            'id' => $this->primaryKey()-> AUTO_INCREMENT,
            'title' => $this->varchar(150)->notNull,
            'text' => $this->text(),
            'url'=> $this-> varchar(150)->notNull,
            'status_id' => $this->tinyint(1)->notNull->default(1),
            'sort'=> $this -> tinyint(2)->notNull->default(99)
        ]);
        $this->createIndex('post_index', 'post', ['created_by', 'updated_by']);
        $this->addForeignKey('fk_post_category', 'post', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_user_created_by', 'post', 'created_by', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_user_updated_by', 'post', 'updated_by', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_post_category', 'post');
        $this->dropForeignKey('fk_post_user_created_by', 'post');
        $this->dropForeignKey('fk_post_user_updated_by', 'post');
        $this->dropTable('blog');
    }
}
