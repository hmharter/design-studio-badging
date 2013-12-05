function refreshissuers() {
  $('#issuers option').detach();
  $.getJSON("listissuers.php", function(data){
    $.each(data, function(i, issuer) {
        var issuerstr = "<option value='" + issuer.id + "'>" + issuer.name + ", " + issuer.url + "</option>";
        // console.log(issuerstr);
        $('#issuers').append(issuerstr);
    });
  });
}

function refreshbadges() {
  $('#badges option').detach();
  $.getJSON("listbadges.php", function(data) {
    $.each(data, function(b, badge) {
      var badgestr = "<option value='" + badge.id + "'>" + badge.name + ", " + badge.criteria + "</option>";
      // console.log(badgestr);
      $('#badges').append(badgestr);
    });
  });
}

function sectionHeight(){
  var windowHeight = $(window).height();
  // console.log("windowHeight: " + windowHeight);
  var minSectionHeight = parseInt($("section").css("min-height"));
  if(windowHeight>minSectionHeight){
    $.each($("section"),function(k,v){
      $(this).css("height",windowHeight);
    });
  }

  $.each($("#intro .wrapper"),function(k,v){
    var section = $(this).parent("section");
    var heightSectionHalf = section.height()/2;
    var heightHalf = $(this).height()/2;
    // console.log("heightSectionHalf: " + heightSectionHalf);
    // console.log("heightHalf: " + heightHalf);
    $(this).css("top",heightSectionHalf);
    $(this).css("top","-="+heightHalf);
  });
}

$(document).ready(function() {
  refreshissuers();
  refreshbadges();
  sectionHeight();
  $('input.claim').addClass("hidden");


  //initialize register dialog
  $( ".register" ).dialog({
    dialogClass: "no-close",
    autoOpen: false,
    height: 550,
    width: 500,
    modal: true,
    buttons: {},
    close: function() {
      allFields.val( "" ).removeClass( "ui-state-error" );
    }
  });
});

$(window).resize(function() {
  sectionHeight();
});

jQuery.fn.scrollMinimal = function(smooth) {
  var cTop = this.offset().top;
  var cHeight = this.outerHeight(true);
  var windowTop = $(window).scrollTop();
  var visibleHeight = $(window).height();

  if (cTop < windowTop) {
    if (smooth) {
      $('body').animate({'scrollTop': cTop}, 'slow', 'swing');
    } else {
      $(window).scrollTop(cTop);
    }
  } else if (cTop + cHeight > windowTop + visibleHeight) {
    if (smooth) {
      $('body').animate({'scrollTop': cTop - visibleHeight + cHeight}, 'slow', 'swing');
    } else {
      $(window).scrollTop(cTop - visibleHeight + cHeight);
    }
  }
};


$(function(){
  var menuOffset = jQuery('header')[0].offsetTop;
  // console.log("menuOffset: " + menuOffset);
  jQuery(document).bind('ready scroll',function() {
    var docScroll = jQuery(document).scrollTop();
    // console.log("docScroll: " + docScroll);
    if(docScroll >= menuOffset-20) {
      jQuery('header').addClass('fixed');
      jQuery('.mainsection').addClass('fixedheader');
    } else {
      jQuery('header').removeClass('fixed');
      jQuery('.mainsection').removeClass('fixedheader');
    }
   });
});