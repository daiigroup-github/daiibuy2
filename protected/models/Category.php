<?php

class Category extends CategoryMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return CMap::mergeArray(parent::rules(), array(
				//code here
				array(
					'category1Id',
					'safe')
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return CMap::mergeArray(parent::relations(), array(
				'subCategorys'=>array(
					self::MANY_MANY,
					'Category',
					'category_to_sub(categoryId, subCategoryId)',
					'order'=>'subCategorys_subCategorys.sortOrder ASC'
				),
				'images'=>array(
					self::HAS_MANY,
					'CategoryImage',
					'categoryId',
					'condition'=>'status=1',
					'order'=>'sortOrder'),
				'fenzerSubCategorys'=>array(
					self::MANY_MANY,
					'Category',
					'category_to_sub(categoryId, subCategoryId)',
					'order'=>'fenzerSubCategorys.title ASC'
				),
				'atechwindowWidth'=>array(
					self::HAS_MANY,
					'Product',
					'categoryId',
					'group'=>'width',
					'order'=>'width'),
				'atechwindowHeight'=>array(
					self::HAS_MANY,
					'Product',
					'categoryId',
					'group'=>'height',
					'order'=>'height'),
				'fenzerToProducts'=>array(
					self::HAS_MANY,
					'Category2ToProduct',
					'category2Id',
					'order'=>'sortOrder'
				),
				'fenzerToProductsCategory1'=>array(
					self::HAS_MANY,
					'Category2ToProduct',
					'category1Id',
					'order'=>'sortOrder'
				),
//				'brandModel'=>array(
//					self::BELONGS_TO,
//					'BrandModel',
//					'brandModelId',)
//            'products' => array(
//                self::MANY_MANY,
//                'Product',
//                'category2_to_product(categoryId, productId)',
//            ),
//            'category2ToProducts' => array(
//                self::HAS_MANY,
//                'Category2ToProduct',
//                'categoryId',
//            ),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * public function search()
	 * {
	 * }
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->categoryId = $this->searchText;
			$this->brandModelId = $this->searchText;
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('categoryId', $this->categoryId, true, 'OR');
		$criteria->compare('brandModelId', $this->brandModelId, true, 'OR');
		$criteria->compare('title', $this->title, true, 'OR');
		$criteria->compare('description', $this->description, true, 'OR');
		$criteria->compare('image', $this->image, true, 'OR');
		$criteria->compare('isRoot', 1);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'sortOrder ASC'
			)
		));
	}

	public function getAllParentCategory($status = 1)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'status&:status>0 AND isRoot=1';
		$criteria->params = array(
			':status'=>$status);

		$models = Category::model()->findAll($criteria);
		$res = array();

		foreach($models as $model)
		{
			$res[$model->categoryId] = $model->title;

			//find child
			$criteria2 = new CDbCriteria();
			$criteria2->condition = 'status&:status>0 AND isRoot =0';
			$criteria2->params = array(
				':status'=>$status);

			$modelChilds = Category::model()->findAll($criteria2);

			foreach($modelChilds as $modelChild)
			{
				$res[$modelChild->categoryId] = $model->title . ' > ' . $modelChild->title;
			}
		}

		return $res;
	}

	public function findAllCategoryBySupplierId($isRoot = 1, $supplierId)
	{
		$result = array();
		$criteria = new CDbCriteria();
		$criteria->condition = 'status = 1 AND isRoot = :isRoot ';
		$criteria->params = array(
			':isRoot'=>$isRoot,
		);

		if(Yii::app()->user->userType != 4)
		{
			$criteria->condition .= " AND supplierId = :supplierId ";
			$criteria->params[":supplierId"] = $supplierId;
		}

		$models = Category::model()->findAll($criteria);

		foreach($models as $item)
		{
			$result[$item->categoryId] = $item->title;
		}

		return $result;
	}

}
