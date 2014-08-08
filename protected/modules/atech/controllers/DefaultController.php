<?php

class DefaultController extends MasterController
{
    public function actionIndex()
    {
        $this->render('index');
    }
}