(function($){
 var cartaTween = TweenMax.from("#home_welcome",1,{opacity:0 , y: 50});
 var sm_welcome_controller = new ScrollMagic.Controller();
 var welcomeScene = new ScrollMagic.Scene({
  triggerElement: '#home_welcome > *',
  triggerHook:.75,
  reverse: false,
  duration: '50%'
 })
 .setTween(cartaTween)
 .addTo(sm_welcome_controller);

 var homeCartaParallax = new ScrollMagic.Scene({
  triggerElement: '.banner-parallax',
  triggerHook:.7,
  duration: '100%'
 })
 .setTween(TweenMax.from('.banner-parallax-img',1,{y:'-60%'}))
 .addTo(sm_welcome_controller);
})(jQuery);
