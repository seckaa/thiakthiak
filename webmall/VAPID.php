<?php
require_once("vendor/autoload.php");

use Minishlink\WebPush\VAPID;

print_r(VAPID::createVapidKeys());

/*
    [publicKey] => BIT0BUrtJS0KlDXxxepoLCla6U1JXRMfjiBgY-g2tomyYo8Krjbp0sGA_WkR0lKtpiBl9o95yb2LtE6FKOCZGpo
    [privateKey] => w3ZyKl8IrD6t_KajPhutqlwuhEt7Av0XNkC3bcNDVgM
*/
