<?php

class My_Controller_Plugin_Layout extends Zend_Controller_Plugin_Abstract
{
   public function preDispatch(Zend_Controller_Request_Abstract $request)
   {
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();

        $setting = Zend_Registry::get('setting');
        $view->site_name = $setting->get_site_name();
   }
}