<?php
include('controler/traitement_tuto_gestion_portfolio.php');
?>
<h3>Gestion du portfolio pour les tutoriels de l'accueil</h3>
<div class="row">
    <div class="col-6">
        <!-- <img src="../public/assets/img/portfolio.png" alt="" class="img-fluid"> -->
        <div class="row align-items-stretch portfolio_img mt-5 pt-5">
            <div class="col-4 mb-0">
                <div class="row ">
                    <div class="col-12 mb-3 position-relative ">
                        <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                1
                        </div>
                        <img src="../public/assets/img/site/<?php echo $portfolio[0]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                    </div>
                    <div class="col-12 position-relative">
                    <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                2
                        </div>
                        <img src="../public/assets/img/site/<?php echo $portfolio[1]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                    </div>
                </div>
            </div>
            <div class="col-4  position-relative mb-0 ">
                <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                        3
                </div>
                <img src="../public/assets/img/site/<?php echo $portfolio[2]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
            </div>
            <div class="col-4 mb-0">
                <div class="row ">
                    <div class="col-12">
                        <div class="row mb-3 ">
                            <div class="col-6 position-relative">
                                <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                        4
                                </div>
                                <img src="../public/assets/img/site/<?php echo $portfolio[3]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                            </div>
                            <div class="col-6 position-relative">
                                <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                        5
                                </div>
                                <img src="../public/assets/img/site/<?php echo $portfolio[4]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3 position-relative">
                        <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                6
                        </div>
                        <img src="../public/assets/img/site/<?php echo $portfolio[5]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                    </div>
                    <div class="col-12 mb-0">
                        <div class="row ">
                                <div class="col-6 mb-0 position-relative">
                                    <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                            7
                                    </div>
                                    <img src="../public/assets/img/site/<?php echo $portfolio[6]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                                </div>
                                <div class="col-6 mb-0 position-relative">
                                    <div class="position-absolute top-50 start-50 fs-1 fw-bold">
                                            8
                                    </div>
                                    <img src="../public/assets/img/site/<?php echo $portfolio[7]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 text-start mt-5">
            <?php
                echo $selects;
            ?>
        </div>
    </div>
</div>

<script src="public/assets/js/select_tuto.js"></script>