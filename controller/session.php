<?php
if(session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
    echo '<script type="text/javascript" src="js/notification.js"></script>';
}
else
{
    session_destroy();
}
?>