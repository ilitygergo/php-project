<?php

class AdminController extends \Controller {
    public function usersAction() {
        $this->redirectIfNotAdmin();

        if (isset($_GET['id'])) {
            $handle = fopen(getenv("LOGS_PATH") . "userUpdate", "r");

            if ($handle) {
                $lastChange = $this->getLastChange($handle);

                fclose($handle);
            }

            include getenv("CURR_VIEW_PATH") . "admin/edit/users.phtml";
        } else {
            include getenv("CURR_VIEW_PATH") . "admin/listing/users.phtml";
        }
    }

    public function ordersAction() {
        $this->redirectIfNotAdmin();

        include getenv("CURR_VIEW_PATH") . "admin/listing/orders.phtml";
    }

    public function productsAction() {
        $this->redirectIfNotAdmin();

        if (isset($_GET['id'])) {
            include getenv("CURR_VIEW_PATH") . "admin/edit/products.phtml";
        } else {
            include getenv("CURR_VIEW_PATH") . "admin/listing/products.phtml";
        }
    }

    /**
     * @param $handle
     *
     * @return string
     */
    public function getLastChange($handle) {
        $last = [];

        while (($line = fgets($handle)) !== false) {
            $pieces = explode(" ", $line);

            if ($pieces[1] == $_GET['id']) {
                if (isset($last[2]) && $last[2] > $pieces[2]) {
                    continue;
                } else {
                    $last = $pieces;
                }

                $date_array[] = $pieces;
            }
        }

        return $this->formatChangeString($last);
    }

    /**
     * @param $last
     *
     * @return string
     */
    public function formatChangeString($last) {
        $user = new User(['id' => $last[0]]);
        $time = str_replace("-",":", $last[3]);

        return $user->getFirstName() . ' ' . $user->getLastName() . ' ' . $last[2] . ' ' . $time;
    }
}
