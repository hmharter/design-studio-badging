var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight,
                       html.clientHeight, html.scrollHeight, html.offsetHeight );


$(".gsissueclick").on("click", function() {
  $(".gsclaim").removeClass("highlight");
  $(".gsissue").toggleClass("highlight");
  $(".gsissue").scrollMinimal();
});
$(".gsclaimclick").on("click", function() {
  $(".gsissue").removeClass("highlight");
  $(".gsclaim").toggleClass("highlight");
  $(".gsclaim").scrollMinimal();
});


$("#registernow").on("click", function() {
  $(".register").dialog("open");
  $(".ui-widget-overlay").css("height",height);
});
$(".cancelreg").on("click", function() {
  $(".register").dialog("close");
});

$("input.regissuer").on("click",function() {
  // console.log("regissuer click");
  $.post('regissuer.php', $("form#regissuer").serialize())
    .done( function(url) {
      // console.log("Issuer URL: " + url);
      $(".register").dialog( "close" );
  });
  refreshissuers();
});

$("input.create").on("click",function() {
  // console.log("create click");
  $.post('badgecreate.php', $("form#createbadge").serialize())
    .done( function(url) {
      // console.log("Badge URL: " + url);
  });
  refreshbadges();
});

$("input.issue").on("click",function() {
  // console.log("issue click");
  $.post('writeassertion.php', $("form#issuebadge").serialize())
    .done( function(url) {
      // console.log("Assertion URL: " + url);
      if (url.indexOf("http") < 0) {
        alert("You have already issued this badge. Please choose another badge or specify a different recipient.");
      }
  });
});

$("input.find").on("click",function() {
  console.log("find click");
  $('#claimbadgeslist input').detach();
  var badgestr = "";
  $.getJSON("findbadges.php", function(data) {
    $.each(data, function(b, badge) {
      badgestr = "<div class='badge'><input type='checkbox' name='earnedbadges' id='" + badge.assertionid + "' value='" + badge.assertionid + "'><label for='" + badge.assertionid + "'><a target='_blank' href='" + badge.criteria + "'>" + badge.name + "</a></label></div>";
      console.log(badgestr);
      $('#claimbadgeslist').append(badgestr);
      $('input.claim').removeClass("hidden");
    });
  });
});


$("input.claim").on("click",function() {
  console.log("claim click");

  var urls = $('#claimbadgeslist input[name=earnedbadges]:checked').map(function () {
    return "http://insys.vmhost.psu.edu/~hms181/badging/data/assertions/" + this.value + ".json";
  }).get();

  OpenBadges.issue(urls,function(errors, successes) {
    if (errors.length>0) {
      console.log("Badge Error:");
      console.log('%j',errors);
    }
    if (successes.length>0) {
      console.dir("Badge Succes:" + successes);
    }
  });
});
