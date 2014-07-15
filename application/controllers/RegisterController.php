<?php

class RegisterController extends My_Controller_Action
{
    /**
     * Trang đăng ký dùng thử
     * @return [type] [description]
     */
    public function indexAction()
    {
        
    }

    /**
     * AJAX function
     * @return [type] [description]
     */
    public function saveAction()
    {
        // Tắt layout và view
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        // kiểm tra AJAX request
        if ( ! $this->getRequest()->isXmlHttpRequest()) {
            exit( json_encode( array( 
                'code' => '-100',
                'error' => 'Require an AJAX request',
                ) ) );
        }

        // lấy params
        $name     = $this->getRequest()->getParam('name');
        $age      = $this->getRequest()->getParam('age');
        $phone    = $this->getRequest()->getParam('phone');
        $email    = $this->getRequest()->getParam('email');
        $address  = $this->getRequest()->getParam('address');
        $city     = $this->getRequest()->getParam('city');
        $district = $this->getRequest()->getParam('district');

        // validate
        if (!$name || strlen(trim($name)) == 0
                || !$district || strlen(trim($district)) == 0
                || !$city || strlen(trim($city)) == 0
                || !$address || strlen(trim($address)) == 0
                || !$email || strlen(trim($email)) == 0
                || !filter_var($email, FILTER_VALIDATE_EMAIL)
                || !$phone || strlen(trim($phone)) == 0
                || !$age || strlen(trim($age)) == 0
                || !intval(trim($age)) > 0
                ) {
            exit( json_encode( array( 
                'code' => '-1',
                'error' => 'Invalid params',
                ) ) );
        }

        try {
            // Chèn và database
            $QUser = new Application_Model_User();
            
            $session = new Zend_Session_Namespace('hanhiet');
            $session->code = sha1($id.(md5($name).time()));

            $data = array(
                'name'     => $name,
                'age'      => $age,
                'phone'    => $phone,
                'email'    => $email,
                'address'  => $address,
                'city'     => $city,
                'district' => $district,
                'session'  => $session->code,
                );

            $id = $QUser->insert($data);

            if ($id > 0) {
                exit( json_encode( array( 
                    'code' => '1',
                    'message' => 'Success',
                    ) ) );
            }

        } catch(Exception $ex) {
            exit( json_encode( array( 
                'code' => '-2',
                'error' => $ex->getMessage(),
                ) ) );
        }

        exit( json_encode( array( 
            'code' => '-3',
            'error' => 'Insert Error',
            ) ) );
        

        
    }

    public function randomAction()
    {
        // Tắt layout và view
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        // kiểm tra AJAX request
        if ( ! $this->getRequest()->isXmlHttpRequest()) {
            exit( json_encode( array( 
                'code' => '-100',
                'error' => 'Require an AJAX request',
                ) ) );
        }

        try {

            $QResult = new Application_Model_Result();

            if ($QResult->random()) {
                $session = new Zend_Session_Namespace('hanhiet');

                if (!isset($session->code) && $session->code) {
                    exit( json_encode( array( 
                        'code' => '-4',
                        'error' => 'Invalid session',
                        ) ) );
                }

                $QUser = new Application_Model_User();
                $where = $QUser->getAdapter()->quoteInto('session = ?', $session->code);
                $user = $QUser->fetchRow($where);

                if (!$user) {
                    exit( json_encode( array( 
                        'code' => '-4',
                        'error' => 'Invalid session',
                        ) ) );
                }

                $data = array('user_id' => $user['id']);
                $id = $QResult->insert($data);

                if ($id > 0) {
                    exit( json_encode( array( 
                        'code' => '1',
                        'message' => 'Success',
                        ) ) );
                }
            }
        } catch (Exception $ex) {
            exit( json_encode( array( 
                'code' => '-2',
                'error' => $ex->getMessage(),
                ) ) );
        }

        exit( json_encode( array( 
            'code' => '-3',
            'error' => 'Insert Error',
            ) ) );

    }
}