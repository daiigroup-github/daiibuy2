<?php

class Amphur extends AmphurMaster
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
        return CMap::mergeArray(parent::rules(), array(//code here
        ));
    }

    /**
     * @return array relational rules.
     */

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return CMap::mergeArray(parent::relations(), array(//code here
            'districts'=>array(
                self::HAS_MANY,
                'District',
                'amphurId',
                'order'=>'districts.districtName'
            ),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array(//code here
        ));
    }
    
        public function getAmphurNameById($id){
        $model = $this->findByPk($id);
        
        return $model->amphurName;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     * public function search()
     * {
     * }
     */
}
