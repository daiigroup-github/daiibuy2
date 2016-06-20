<?php

class UserPartner extends UserPartnerMaster
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
        return CMap::mergeArray(parent::relations(), array(
        //code here
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
      public function search()
      {
      }
     */
    public function findPartnerTypeByCode($code)
    {
        $code = $code;
        $codeArray = explode("-", $code);
        $partnerType = NULL;
        if (strtolower($codeArray[0]) == "org") {
            $partnerType = 1;
        } else if (strtolower($codeArray[0]) == "wow") {
            $partnerType = 2;
        } else {
            throw new CHttpException("Partner type is incorrect!!", 500);
        }

        return $partnerType;
    }

    public function findPartnerDiscount($userId, $supplierId, $summary)
    {
        $percent = 0;
        $user = User::model()->findByPk($userId);
        $code = $user->partnerCode;
//		throw new Exception(print_r($user, true));

        $partnerType = (isset($user->partnerCode) && !($user->partnerCode == "")) ? $this->findPartnerTypeByCode($user->partnerCode) : 0;
//		$code = isset($user->partnerCode) ? $user->partnerCode : 0;
        $result = array();

        if ($partnerType != 0) {
            // Discount Type
            //Type 1 = %
            //Type 2 = Amount
            if ($partnerType == 1) {
                $orgEmp = OrgEmployee::model()->find("lower(code) = '" . strtolower($code) . "'");
                $result["discountType"] = 2;
                $result["discount"] = $orgEmp->org->discountPercent;
            } else {
                $link = Link::model()->find("lower(linkCode) = '" . strtolower($code) . "'");
                $linkItems = LinkItems::model()->find("linkId = $link->linkId AND supplierId = $supplierId");
                //throw new Exception($code);
                //throw new Exception(print_r($linkItems->attributes, true));
                $result["discountType"] = $linkItems["discountType"];
                //throw new Exception(print_r($linkItems->attributes, true));
                $result["discount"] = $linkItems["value"];
            }
            return $result;
        } else {
            return NULL;
        }
    }

}
