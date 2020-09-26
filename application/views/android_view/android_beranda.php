<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Beranda</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>

<body class="bg-light">

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <a href="<?php echo base_url(); ?>Android_controller" class="navbar-brand"><img src="<?php echo base_url();?>images/dlsu.png" class="dlsu">
                    <span style="color: white;">Troubleshooting<br><small>Perangkat Komputer</small></span>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="<?php echo base_url('Android_controller'); ?>">Beranda</a>
                </li>
                <li>
                    <a href="<?php echo base_url('Android_controller/list_perangkat?w=Hardware'); ?>">Perangkat Keras</a>
                </li>
                <li>
                    <a href="<?php echo base_url('Android_controller/list_perangkat?w=Software'); ?>">Perangkat Lunak</a>
                </li>
                <hr>
                <li>
                    <a href="<?php echo base_url('Android_controller/login'); ?>">Login</a>
                </li>
            </ul>
        </nav>

        <!-- Konten  -->
        <div id="content">

                <div class="border bg-light shadow rounded d-flex justify-content-between" style="overflow: hidden; margin: 0px auto;">
                   
                    <div style="z-index: 299; margin-top: 2px;" class="p-1">
                        <button type="button" id="sidebarCollapse" class="btn btn-default">
                            <i class="fas fa-bars" style="color: #7C7C7D;"></i>
                        </button>
                    </div>

                    <form class="searchbox" action="<?php echo base_url('Android_controller/cari'); ?>" method="post">
                        <input type="search" placeholder="Cari solusi..." name="cariSolusi" class="searchbox-input" onkeyup="buttonUp();" required>
                        <input type="submit" class="searchbox-submit" value="Cari">
                        <span class="searchbox-icon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </form>                

                </div>

                <div class=" mt-4">
                    <div class="row padding justify-content-center">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card margin-btm">
                                        <a href="<?php echo base_url('Android_controller/list_perangkat?w=Hardware') ?>" class="btn btn-outline-success bg-light"><i class="fa fa-desktop"></i><br><hr>Perangkat Keras</a>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card margin-btm">
                                        <a href="<?php echo base_url('Android_controller/list_perangkat?w=Software') ?>" class="btn btn-outline-warning bg-light"><i class="far fa-window-restore"></i><br><hr>Perangkat Lunak</a>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="<?= base_url(); ?>assets/js/android.js"></script>

</body>

</html>