<?php

class Controller {
    /**
     * @var Loader
     */
    protected $loader;

    /**
     * Controller constructor.
     */
    public function __construct(){
        $this->loader = new Loader();
    }

    /**
     * @param $url
     * @param $message
     * @param int $wait
     */
    public function redirect($url, $message, $wait = 0){
        if ($wait == 0){
            header("Location:$url");
        } else {
            include CURR_VIEW_PATH . "message.html";
        }

        exit;
    }

    /**
     *
     */
    public function redirectIfNotAdmin() {
        if ((Session::getInstance())->getUserId() != (Website::getInstance())->getId() ) {
            redirect_to('/');
        }
    }
}
