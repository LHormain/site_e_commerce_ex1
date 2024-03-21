<?php
if(isset($_GET['dis']) && $_GET['dis'] == 1) {
    // session_destroy();
    unset($_SESSION['id_client']);
    // header("location:index.php");
    ?>
    <script>
        // force le rechargement de la page
        window.location.assign("index.php?page=6");
    </script>
    <?php
}

?>