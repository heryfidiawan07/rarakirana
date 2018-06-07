$(document).ready(function(){
//Memasukan table ke div class tabAuto
	$('table').each(function () {
    var tab = $(this);
    $(this).before('<div style="overflow-x:auto;" class="tabAuto"></div>');
    $('.tabAuto').each(function () {
        var auto = $(this);
        $(tab).prependTo(auto);
    });
  });

//Responsive Embed Video	
  $('iframe[src]').each(function () {
    var iframe = $(this);
    $(this).before('<div class="embed-responsive embed-responsive-16by9"></div>');
    $('.embed-responsive').each(function () {
        var embed = $(this);
        $(iframe).prependTo(embed);
    });
  });

});//End Document Ready