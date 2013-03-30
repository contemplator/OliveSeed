<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('Application.Controller.php');
require_once ('Guestbook.Model.php');

class GuestbookController extends ApplicationController {

    public function postAction() {

        if ($_POST['submit']) {

            $model = new GuestbookModel(
                    $this->_config['dbhost'], $this->_config['dbuser'], $this->_config['dbpassword'], $this->_config['dbname']);

            try {
                $model->write($_POST['name'], $_POST['email'], $_POST['text']);
                echo '<a href="index.php?controller=guestbook">留言完成，前往看留言</a>';
                exit;
            } catch (Exception $e) {

                die('留言寫入失敗：' . $e->getMessage());
            }
        }
    }

    public function indexAction() {

        $model = new GuestbookModel($this->_config['dbhost'], $this->_config['dbuser'], $this->_config['dbpassword'], $this->_config['dbname']);


        $pagesize = 10;

        $page = 1;
        $offset = ($page - 1) * $pagesize;

        $entries = $model->page($offset, $pagesize);
        $this->view->entries = $entries;
    }

}

?>
