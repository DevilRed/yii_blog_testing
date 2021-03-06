<?php

namespace common\models;

use Yii;
// for using the behaviors
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $lead_photo
 * @property string $lead_text
 * @property string $content
 * @property string $meta_description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $category_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    // adding behavior to this model
    public function behaviors()
    {
        return [
        'timestamp' => [
        'class' => TimestampBehavior::className(),
        'attributes' => [
        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
        ],
        'value' => new Expression('NOW()'),
        ],
        [
        'class' => BlameableBehavior::className(),
        'createdByAttribute' => 'created_by',
        'updatedByAttribute' => 'updated_by',
        ],
        [
        'class' => SluggableBehavior::className(),
        'attribute' => 'title',
        'slugAttribute' => 'slug',
        ],
        ];
    }

    /**
     * @inheritdoc
     * override rules() method by returning the rules that the model attributes should satisfy.
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'content', 'created_at', 'created_by', 'category_id'], 'required'],
            [['lead_text', 'content'], 'string'],
            // [['created_at', 'updated_at'], 'safe'],// removing as these fields are automatically filled before saving model
            // [['created_by', 'updated_by', 'category_id'], 'integer'],// removing as these fields are automatically filled before saving model
            // [['title', 'slug', 'lead_photo'], 'string', 'max' => 128],// removing as these fields are automatically filled before saving model
            [['meta_description'], 'string', 'max' => 160],
            [['title'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     * we are declaring attribute labels. For applications supporting multiple languages, we can translate them here with Yii::t() component.
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'lead_photo' => 'Lead Photo',
            'lead_text' => 'Lead Text',
            'content' => 'Content',
            'meta_description' => 'Meta Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'category_id' => 'Category ID',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }
}
