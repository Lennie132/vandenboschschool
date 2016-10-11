$(document).ready(function(){
  console.log("team");
  $(window).load(function() {
    $('.team-member__description').dotdotdot({
      watch: "window"
    });
  });
});
