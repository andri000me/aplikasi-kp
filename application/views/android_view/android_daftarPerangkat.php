<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Daftar Perangkat</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body class="bg-light">

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <a href="<?php echo base_url(); ?>Android_controller" class="navbar-brand"><img src="<?php echo base_url();?>images/dlsubig.png" class="dlsu">
                    <span style="color: white;">Troubleshooting<br><small>Perangkat Komputer</small></span>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?php echo base_url('Android_controller'); ?>">Beranda</a>
                </li>
                <?php if ($jenisPerangkat->w_kind == "Hardware") { ?>
                    <li>
                        <a href="<?php echo base_url('Android_controller/list_perangkat?w=Hardware'); ?>">Perangkat Keras</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Android_controller/list_perangkat?w=Software'); ?>">Perangkat Lunak</a>
                    </li>
                <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url('Android_controller/list_perangkat?w=Hardware'); ?>">Perangkat Keras</a>
                    </li>
                    <li class="active">
                        <a href="<?php echo base_url('Android_controller/list_perangkat?w=Software'); ?>">Perangkat Lunak</a>
                    </li>
                <?php } ?>
                <hr>
                <li>
                    <a href="<?php echo base_url('Android_controller/login'); ?>">Login</a>
                </li>
            </ul>
        </nav>

        <!-- Konten  -->
        <div id="content">

                <div class="border bg-light shadow rounded d-flex justify-content-between billStickTop">
                    <div style="z-index: 299; margin-top: 2px;" class="p-1">
                        <button type="button" id="sidebarCollapse" class="btn btn-default">
                            <i class="fas fa-bars" style="color: #7C7C7D;"></i>
                        </button>
                    </div>

                    <div style="color: #7C7C7D;" class="p-1">
                        <button class="btn btn-default" disabled><b style="text-transform: uppercase;"><?php echo $jenisPerangkat->w_kind; ?></b></button>
                    </div>

                    <form class="searchbox" action="<?php echo base_url('Android_controller/cari'); ?>" method="post">
                        <input type="search" placeholder="Cari solusi..." name="cariSolusi" class="searchbox-input" onkeyup="buttonUp();" required>
                        <input type="submit" class="searchbox-submit" value="Cari">
                        <span class="searchbox-icon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </form> 
                </div>
                <div class="mt-4">
                    <?php foreach ($daftar_perangkat as $val) : ?>
                        <a href="<?php echo base_url('Android_controller/list_solusi?wId=').$val->w_id ?>" style="text-decoration: none;">
                            <button class="btn btn-default bg-light btn-block rounded-lg shadow-lg mb-2 p-3" style="font-size: 12pt; text-align: left;">
                                <span>
                                    <img src="<?= base_url('/assets/icon/');?><?=$val->w_icon?>" class="mr-3" style="max-width: 32px;"><?php echo $this->bbcode->parse($val->w_name); ?>
                                </span>
                            </button>
                        </a>
                    <?php endforeach; ?>
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

    <script type="text/javascript" src="<?= base_url(); ?>assets/js/android.js"></script></body>

</html>