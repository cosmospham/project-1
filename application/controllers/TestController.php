<?php

class TestController extends My_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        $QRes = new Application_Model_Result();
        var_dump($QRes->random());
    }

}