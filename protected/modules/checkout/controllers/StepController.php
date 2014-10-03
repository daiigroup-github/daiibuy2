<?php

class StepController extends MasterCheckoutController
{
    public function actionIndex($id)
    {
        $userModel = new User();
        $addressModel = new Address();

        if (isset($_POST['Login']) || isset($_POST['Register'])) {
            $this->step1();
        }

        /*
        switch($id) {
            case 1:
                $this->step1();
                break;
            case 2:
                $this->step2();
                break;
            case 3:
                $this->step3();
                break;
            case 4:
                $this->step4();
                break;
            case 5:
                $this->step5();
                break;
        }
        */

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

    public function step2()
    {
        $this->redirect($this->createUrl(3));
    }

    public function step3()
    {
        $this->redirect($this->createUrl(4));
    }

    public function step4()
    {
        $this->redirect($this->createUrl(5));
    }

    public function step5()
    {
    }
}