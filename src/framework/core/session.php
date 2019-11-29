<?php

class Session {

    /**
     * @var Session
     */
    private static $instance = null;

    /**
     * @var int
     */
    private $user_id;

    /**
     * Session constructor.
     */
    public function __construct() {
        session_start();
        $this->checkStoredLogin();
    }

    /**
     * @return Session
     */
    public static function getInstance() {
        if (self::$instance == null)  {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    /**
     * @param UserModel $user
     */
    public function login($user) {
        if ($user) {
            session_regenerate_id();
            $_SESSION['user_id'] = $user->getId();
            $this->user_id = $user->getId();
        }
    }

    /**
     * @return bool
     */
    public function isLoggedIn() {
        return isset($this->user_id);
    }

    /**
     * @return bool
     */
    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        return TRUE;
    }

    /**
     *
     */
    private function checkStoredLogin() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
        }
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->user_id;
    }
}
