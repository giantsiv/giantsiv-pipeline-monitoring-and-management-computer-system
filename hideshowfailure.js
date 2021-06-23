<script src="jquery-3.4.1.min.js">
$(window).on("load", function()
{
  $(".option3").each(function()
   {
    if($(this).children(".child3").length == 0)
      {
        $(this).hide();
      }
  });         
});
</script>