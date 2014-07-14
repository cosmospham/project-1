<?php

class AjaxController extends My_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ( ! $this->getRequest()->isXmlHttpRequest() ) {
            exit( json_encode( array(
                'code' => '-100',
                'error' => 'Only accept AJAX requests',
                ) ) );
        }
    }

    
    
}