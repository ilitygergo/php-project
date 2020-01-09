<?php

class RegisterController extends \Controller {
    public function indexAction() {
        if (isPostRequest() && isset($_POST['user'])) {
            $user = new User($_POST['user']);
            $user->setPassword($_POST['user']['password']);

            if (is_integer($result = $user->save())) {
                $user->setId($result);
                $user->login();

                UserLogger::saveEntry('LOGIN', $user);
            }

            if (Alert::getInstance()->isAlertEmpty()) {
                redirect_to('/');
            }
        }

        include getenv("CURR_VIEW_PATH") . "user/register.phtml";
    }
}
