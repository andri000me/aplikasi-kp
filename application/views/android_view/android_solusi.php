<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Solusi</title>

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

            <!--<ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>-->
        </nav>

        <!-- Konten -->
        <div id="content">

                <div class="border bg-light shadow rounded d-flex justify-content-begin billStickTop">
                    <div class="col-1" style="z-index: 299;">
                        <button type="button" id="sidebarCollapse" class="btn btn-default">
                            <i class="fas fa-bars" style="color: #7C7C7D;"></i>
                        </button>
                    </div>

                    <div class="col-11" style="color: #7C7C7D; overflow: hidden;">
                        <button class="btn btn-default" disabled>
                            <b style="text-transform: uppercase;"><?php echo $this->bbcode->parse($solusi->title); ?></b>
                        </button>
                    </div>
                </div>

                <div class="bg-white mt-3 p-3 shadow">
                        <h4><b>Penjelasan</b></h4><hr>
                        <?php echo $this->bbcode->parse($solusi->detail); ?>
                </div>

                    <div class="bg-white mt-2 p-3 shadow" style="overflow: hidden;">
                        <h4><b>Langkah Penyelesaian</b></h4><hr>
                        <?php echo $this->bbcode->parse($solusi->solving); ?>
                        <!--Modal preview gambar-->
                        <div id="modalImgPreview" class="modalImg">
                          <span class="closeImgPrev">&times;</span>
                          <img class="ImgContent" id="img01">
                        </div>                        

                          <?php if (!empty($solusi->video)) { ?>
                          <div class="p-2"><small><b>Video</b><br></small>
                              <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?php echo $solusi->video ?>" allowfullscreen></iframe>
                              </div> <hr> <!--UKURAN VIDEO COBA LIA ULANG-->
                          </div>
                        <?php } ?>                        
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

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });

        //IMAGE PREVIEW
        // Get the modal
        var modal = document.getElementById("modalImgPreview");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeImgPrev")[0];

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("imgPreview");
        var modalImg = document.getElementById("img01");
        //var captionText = document.getElementById("caption");
        if (img != null) {
        img.onclick = function(){
          span.style.display = "block";
          modal.style.display = "block";
          modalImg.src = this.src;
          //captionText.innerHTML = this.alt;
        };
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        };        
    </script>
</body>

</html>