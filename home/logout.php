<?
session_unset();
session_destroy();

unset($_COOKIE['acc_token']);
unset($_COOKIE['rf_token']);
unset($_COOKIE['role']);
unset($_COOKIE['user']);
unset($_COOKIE['permission']);

setcookie('acc_token', null, -3600, '/','.timviec365.vn');
setcookie('rf_token', null, -3600, '/','.timviec365.vn');
setcookie('role', null, -3600, '/','.timviec365.vn');
setcookie('user', null, -3600, '/', '.timviec365.vn');
setcookie('permission', null, -3600, '/', '.timviec365.vn');


if (!isset($_COOKIE['acc_token']) && !isset($_COOKIE['rf_token']) && !isset($_COOKIE['role']) && !isset($_COOKIE['user'])) {
    header('Location: /');
    exit();
}

?>
