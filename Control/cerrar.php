<?php @session_start(); ?>

<?php

$_SESSION = array();
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_unset();
session_destroy();
?>
<script type="text/javascript">
    pagina = '../index.php'
    tiempo = 10
    ubicacion = '_self'
    setTimeout("open (pagina, ubicacion)", tiempo)
</script>