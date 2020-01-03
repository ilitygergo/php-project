<?php
    ob_start();
    date_default_timezone_set('Europe/Budapest');

    Model::setDb((new Mysql())->getConnection());
    Website::getInstance();
    Session::getInstance();
    Alert::getInstance();
