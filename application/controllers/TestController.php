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
        $mail = new My_Functions_Mail();
        $mail->send('Test Zend', 'cái đệt. haha, thằng khùng', 'phamquocbuu@gmail.com', 'boo');
        echo "done";

    }

}