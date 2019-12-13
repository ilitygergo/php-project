<?php
ob_start();
date_default_timezone_set('Europe/Budapest');
require "framework/core/Framework.php";

Framework::run();
