<?php

class SaleQueue extends SaleQueueMaster
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
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
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

    public function getProvinceNameById($id)
    {
        $model = $this->findByPk($id);

        return $model->provinceName;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     * public function search()
     * {
     * }
     */
    public function findAllProvinceArray()
    {
        $result = array();
        foreach ($this->findAll() as $item) {
            $result[$item->provinceId] = $item->provinceName;
        }

        return $result;
    }

}
