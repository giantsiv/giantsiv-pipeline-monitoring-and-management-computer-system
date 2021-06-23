$(document).ready(    function()
{
  $(".option3").each(function()
   {
    if($(this).children(".child3").length == 0)
      {
        $(this).hide();
      }
  });         
});