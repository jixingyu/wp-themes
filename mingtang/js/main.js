(function(){
    $(document).on("click",".dropdown-toggle",function(){
        if( $(window).width() > 767 ){
            if($(this).attr('href')) window.location = $(this).attr('href');
        }
    });
})()
