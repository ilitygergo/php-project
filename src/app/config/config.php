<?php
    ob_start();
    date_default_timezone_set('Europe/Budapest');

    App\Framework\Core\Model::setDb((new App\Framework\Database\Mysql())->getConnection());
    App\Models\Website::getInstance();
    App\Framework\Core\Session::getInstance();
    App\Framework\Core\Alert::getInstance();
