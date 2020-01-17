<?php
namespace App\Models\Logger;

class UserLogger extends Logger {
    /**
     * @return string
     */
    public static function getLastUserUpdateRow($id) {
        $path = 'user/update/' . $id;

        return parent::getLastRow($path);
    }

    public static function saveUserUpdate($id) {
        $user = new User(
            [
                'id' => Session::getInstance()->getUserId()
            ]
        );

        $path = "user/update/" . $id;
        $message = $user->fullName() . " " . date("Y-m-d H:i:s");

        Logger::insertRow($path, $message);
    }

    /**
     * @param string $action
     * 
     * @param User $user
     */
    public static function saveEntry($action, $user) {
        $path = 'user/entries';
        $message = $action . ' - id: ' . $user->getId() . ' name: ' . $user->fullName() . ' date: ' . date('Y-m-d H:i:s');

        parent::insertRow($path, $message);
    }
}
