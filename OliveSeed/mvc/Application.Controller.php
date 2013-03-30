<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class ApplicationController {

    protected $_request;
    protected $_config;
    protected $_viewPath = 'views/';
    public $view;

    public function __construct($request, $config) {

        $this->_request = $request;
        $this->_config = $config;
        $this->view = new stdClass();
    }

    public function run() {

        $action = $this->_request['action'];
        if (!$action)
            $action = 'index';

        $actionCalled = $action . 'Action';     // indexAction
        $viewFile = $action . '.phtml';         // index.phtml


        call_user_func(array($this, $actionCalled));


        $html = $this->render($viewFile);

        echo $html;
    }

    public function render($viewFile = NULL) {       // index.phtml
        $viewPath = $this->_viewPath . $this->_request['controller'] . '/' . $viewFile;

        ob_start();
        include $viewPath;
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    abstract function indexAction();
}

?>
