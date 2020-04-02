<?php
/**
 * Project: afisha
 * Filename: logout.php
 * Date: 12/15/2019
 * Time: 8:56 PM
 */
session_start();
require_once '../Session.php';

Session::destroy();

header('Location: auth.php?msg=Вы вышли!');