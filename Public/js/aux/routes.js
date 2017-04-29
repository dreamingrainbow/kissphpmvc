function scrollTo(id)
{
     $("html, body").delay(2000).animate({scrollTop: $('#'+id).offset().top }, 2000);
}
function toggleSection(e, id)
{
     $('#'+id).toggleClass("open");
     if($('#'+id).hasClass('open'))
     {
          e.innerHTML = '<em class="glyphicon glyphicon-minus" style="padding: 2px 3px;"></em>';
          $('#'+id).toggle();
     }
     else
     {
          e.innerHTML = '<em class="glyphicon glyphicon-plus" style="padding: 2px 3px 4px 3px"></em>';
          $('#'+id).toggle();
     }     
}
