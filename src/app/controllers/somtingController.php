<?php

class somtingController extends \Controller{
    /**
     *
     */
    public function indexAction(){
        include  CURR_VIEW_PATH . "somting.phtml";

        $mysql = new Mysql();
    }
}
