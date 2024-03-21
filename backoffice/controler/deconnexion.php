<?php
if(isset($_GET['dis']) && $_GET['dis'] == 1) {
    session_destroy();
    // header("location:/index.php");
    ?>
    <script>
        // force le rechargement de la page
        window.location.assign("index.php");
    </script>
    <?php
}

?>