$(document).ready(function(){
  $(window).load(function() {
        $('.team-member__name').dotdotdot({
      watch: "window"
    });
        $('.team-member__function').dotdotdot({
      watch: "window"
    });
    $('.team-member__description').dotdotdot({
      watch: "window"
    });
  });
});
