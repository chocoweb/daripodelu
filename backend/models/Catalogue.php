<?php

namespace backend\models;

use Yii;
use backend\behaviors\ImagesBehavior;
use common\models\Image;

/**
 * This is the model class for table "{{%catalogue}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $uri
 * @property integer $user_row
 *
 * @property Product[] $products
 */
class Catalogue extends \yii\db\ActiveRecord
{
    const IS_USER_ROW = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalogue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'uri', 'parent_id', 'user_row'], 'required'],
            [['id', 'parent_id', 'user_row'], 'integer'],
            [['uri'], 'unique'],
            [['name', 'uri'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID категории'),
            'parent_id' => Yii::t('app', 'Родительской категории'),
            'name' => Yii::t('app', 'Название'),
            'uri' => Yii::t('app', 'URI'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
//        return $this->hasMany(Product::className(), ['catalogue_id' => 'id']);
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%catalogue_product}}', ['catalogue_id' => 'id']);
    }

    /**
     * Returns the list of parent categories
     * @param null $parentId
     * @return array
     */
    public function parents($parentId = null)
    {
        $parentId = is_null($parentId) ? $this->parent_id : $parentId;
        $category = $this->findOne(['id' => $parentId]);

        if (is_null($category)) {
            return [];
        }
        $list[] = $category;

        if ($category->parent_id !== 0) {
            $list = array_merge($list, $this->parents($category->parent_id));
        }

        return $list;
    }

    public function behaviors()
    {
        return [
            'photo' => [
                'class' => ImagesBehavior::className(),
                'model' => 'catalogue',
                'ownerIdAttribute' => 'id',
            ],
        ];
    }

    public function getPhoto()
    {
        return $this->hasOne(Image::className(), ['owner_id' => 'id'])->andWhere(['model' => 'catalogue'])->andWhere(['ctg_id' => 0])->orderBy(['is_main' => SORT_DESC, 'owner_id' => SORT_ASC]);
    }
}
