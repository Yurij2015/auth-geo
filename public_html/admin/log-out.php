<?php
session_start();
session_unset();
header("Location: /admin/log-in.php?msg=Вы выши с системы!");
