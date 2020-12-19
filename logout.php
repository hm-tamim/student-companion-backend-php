<?php
/**
 * Created by PhpStorm.
 * User: HM Tamim
 * Date: 7/18/2019
 * Time: 12:18 PM
 */

session_start();
session_destroy();

header('Location: /');