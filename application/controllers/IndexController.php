<?php

class IndexController extends My_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * Giao diện trang bắt đầu
     * @return [type] [description]
     */
    public function indexAction()
    {
       var_dump( My_Controller_Plugin_Mobile::is_mobile() );
    }


}

