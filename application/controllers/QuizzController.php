<?php

class QuizzController extends My_Controller_Action
{
    /**
     * Giao diện trang câu hỏi
     * @return [type] [description]
     */
    public function indexAction()
    {
        
    }

    /**
     * AJAX
     * Lấy câu hỏi kế tiếp
     * @return [type] [description]
     */
    public function getAction()
    {
        
        $current = $this->getRequest()->getParam('current');
        $answer = $this->getRequest()->getParam('answer');

        // xác định câu hỏi kế tiếp
        // render view tương ứng
    }
}