<?php

class RegisterController extends \Controller {
    /**
     *
     */
    public function indexAction() {
        include getenv("CURR_VIEW_PATH") . "user/register.phtml";
    }
}
