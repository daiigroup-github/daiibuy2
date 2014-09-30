<?php

class StepController extends MasterCheckoutController
{
    public function actionIndex($id)
    {
        $userModel = new User();
        $addressModel = new Address();

        if(isset($_POST['Login']) || isset($_POST['Register'])) {
            switch($id) {
                case 1:
                    $this->step1();
                    break;
            }
        }


        $this->render('index', array('step' => $id, 'userModel' => $userModel, 'addressModel' => $addressModel));
    }

    public function step1()
    {
        //Login
        if (isset($_POST['Login'])) {
            echo $_POST['Login'];
        }

        //Register new user
        if (isset($_POST['Register'])) {
            echo $_POST['Register'];
        }

        $this->redirect($this->createUrl(2));
    }
}