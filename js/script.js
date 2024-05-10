// INPUT FIELDS

$(function() {
   $(".input input").focus(function() {
      $(this).parent(".input").each(function() {
         $("label", this).addClass("label-active label-blue")
         $("input", this).addClass("line-active")
      });
   }).blur(function() {
      $("input").removeClass("line-active")
     $("label").removeClass("label-blue")
      if ($(this).val() == "") {
         $(this).parent(".input").each(function() {
            $("label", this).removeClass("label-active")
         });
      }
   });

});

// CARD SWAPPING

$(".account-check").click(function(){
    $(".card").toggleClass("hidden");
  
  $("#register").removeClass("register-swap");
  $("#login").removeClass("login-swap");
  setTimeout(function() {
    $("#register").addClass("register-swap");
  $("#login").addClass("login-swap");
}, 50);
});


// MOUSE EVENTS

$('#phone *').mouseover(function(){
  $(this).css({cursor: 'none'});
});

$(document).on('mousemove', function(e){
  $('#cursor').css({
    left:  e.pageX,
    top:   e.pageY
  });
});

$( "#phone" ).mouseover(function() {
  $( "#cursor" ).css("display", "block")
});

$( "#phone *" ).mouseout(function() {
  $( "#cursor" ).css("display", "none")
});

$( "#phone *" ).mousedown(function() {
   $( "#cursor" ).css("transform", "scale(0.8)")
});

$( "#phone *" ).mouseup(function() {
   $( "#cursor" ).css("transform", "scale(1)")
});


// CLOCK

var $document = $(document);
(function () { 
  var clock = function () {
      clearTimeout(timer);
    
      date = new Date();    
      hours = date.getHours();
      minutes = date.getMinutes();
      dd = (hours >= 12) ? 'pm' : 'am';
      hours = (hours > 12) ? (hours - 12) : hours
      
      var timer = setTimeout(clock, 10000);
    
    $('.hours').html('<p>' + Math.floor(hours) + ':</p>');
    $('.minutes').html('<p>' + Math.floor(minutes) + '</p>');
   $('.twelvehr').html('<p>' + dd + '</p>');
  };
  clock();
})();


