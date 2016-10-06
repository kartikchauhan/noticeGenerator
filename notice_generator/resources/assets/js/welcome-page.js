$(function(){
    var userDate, noticeDate;

        // setting the format of date-picker

        $('#date-picker').datepicker({
            format: "yyyy-mm-dd"
        });

        // showing image in the modal

        $('.pop').on('click',function(){
            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
            $('#imageModal').modal('show');
        });

        // getting value of department which the user has selected and showing results accordingly

        $('#departments').on('change', function(){
            if($('#date-picker').val()=="") // showing results based upon selected department when no date has been selected
            {                
                $('.notice-container').each(function(){                
                    if($(this).find('.department-id').val() != $('#departments').val())
                        $(this).hide();
                    else
                        $(this).show();
                });                
            }
            else // showing results based upon selected department when date has been selected
            {                
                userDate = Date.parse($('#date-picker').val());
                noticeDate;
                $('.notice-container').each(function(){
                    noticeDate = Date.parse($(this).find('#compare-date').val());
                    if(($(this).find('.department-id').val() == $('#departments').val()) && noticeDate>=userDate)
                        $(this).show();
                    else
                        $(this).hide();
                });
            }
        });

        $('#date-picker').on('change', function(){            
            userDate = Date.parse($('#date-picker').val());            
            if($('#departments').val()==null) // showing results based upon selected date when no department has been selected
            {
                $('.notice-container').each(function(){
                    noticeDate = Date.parse($(this).find('#compare-date').val());
                    if(noticeDate<userDate)
                        $(this).hide();
                    else
                        $(this).show();
                });                
            }
            else // showing results based upon selected date when a department has been selected
            {
                $('.notice-container').each(function(){
                    noticeDate = Date.parse($(this).find('#compare-date').val());
                    if(($(this).find('.department-id').val() == $('#departments').val()) && noticeDate>=userDate)
                        $(this).show();
                    else
                        $(this).hide();
                });
            }
        });
        
        // scroll functions to take user to the top of the page
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
    });