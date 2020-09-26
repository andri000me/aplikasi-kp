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

        //search bar
         $(document).ready(function(){
                    var submitIcon = $('.searchbox-icon');
                    var inputBox = $('.searchbox-input');
                    var searchBox = $('.searchbox');
                    var isOpen = false;
                    submitIcon.click(function(){
                        if(isOpen == false){
                            searchBox.addClass('searchbox-open');
                            inputBox.focus();
                            isOpen = true;
                        } else {
                            searchBox.removeClass('searchbox-open');
                            inputBox.focusout();
                            isOpen = false;
                        }
                    });  
                     submitIcon.mouseup(function(){
                            return false;
                        });
                    searchBox.mouseup(function(){
                            return false;
                        });
                    $(document).mouseup(function(){
                            if(isOpen == true){
                                $('.searchbox-icon').css('display','block');
                                submitIcon.click();
                            }
                        });
                });
                    function buttonUp(){
                        var inputVal = $('.searchbox-input').val();
                        inputVal = $.trim(inputVal).length;
                        if( inputVal !== 0){
                            $('.searchbox-icon').css('display','none');
                        } else {
                            $('.searchbox-input').val('');
                            $('.searchbox-icon').css('display','block');
                        }
                    } 