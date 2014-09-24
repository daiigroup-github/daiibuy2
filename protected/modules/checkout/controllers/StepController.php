<?php

class StepController extends MasterCheckoutController
{
    public function actionIndex($id)
    {
        $this->render('index', array('step'=>$id));
    }
}