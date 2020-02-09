

$('.off-canvas-toggle').on('click', function(e) {
    e.preventDefault();
    $('.wrapper').fadeIn("fast");
    var direction = $('.off-canvas__container').data('off-canvas-direction');
    $('.off-canvas').addClass('off-canvas--' + direction);
    $('.mobile-nav').addClass('pushed');
    $(this).addClass('active');
    $('.mobile-nav').fadeIn();
    $('#mobile_menu_close_cross_icon').show();
});

$('.off-canvas__content').on('click', '.nav-click', function(e) {
    e.preventDefault();
    $('.wrapper').fadeIn();


    $this = $(this);
    $this.children('i').toggleClass('fa fa-fw fa-angle-up').toggleClass('fa fa-fw fa-angle-down');
    $item = $this.parent('.nav__item');
    $item.toggleClass('nav__item--open');
    if($item.hasClass('nav__item--open')) {
        $item.siblings().find('.nav__item--open').removeClass('nav__item--open');
        $item.siblings().find('.fa fa-fw fa-angle-up').addClass('fa fa-fw fa-angle-down').removeClass('fa fa-fw fa-angle-up');
        $item.siblings().removeClass('nav__item--open');




    }
    $('.mobile-nav').fadeIn();
   // $('#mobile_menu_close_cross_icon').hide();



});
