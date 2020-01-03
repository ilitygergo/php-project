<?php

class Alert {
    /**
     * @var Alert
     */
    private static $instance = null;

    /**
     * @var []
     */
    public $alerts = [];

    public function __construct() {
        session_start();
        $this->checkStoredAlerts();
    }

    /**
     * @return Alert
     */
    public static function getInstance() {
        if (self::$instance == null)  {
            self::$instance = new Alert();
        }

        return self::$instance;
    }

    /**
     * @param string $alert
     */
    public function add($alert) {
        if ($alert) {
            session_regenerate_id();
            $_SESSION['alerts'][] = $alert;
            $this->alerts[] = $alert;
        }
    }

    /**
     * return bool
     */
    public function isAlertEmpty() {
        return empty($this->alerts);
    }

    /**
     * @return string
     */
    public function alertMessages() {
        $message = '';

        if (!empty($this->alerts)) {
            foreach ($this->alerts as $alert) {
                $message .= "<div class=\"alert alert-danger\" role=\"alert\">$alert</div>";
            }
        }

        return $message;
    }

    private function checkStoredAlerts() {
        if (isset($_SESSION['alerts'])) {
            $this->alerts = $_SESSION['alerts'];
        }
    }

    public function removeAlerts() {
        unset($_SESSION['alerts']);
        unset($this->alerts);
    }
}
