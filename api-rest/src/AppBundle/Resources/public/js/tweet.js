/**
 * Created by Pierre-Antoine on 27/10/2016.
 */
$(document).ready(function(){

   $(".save_tweet").on("click", function(){

      var route = $(this).attr('route');
      var divToHide = $(this).parent().parent();

      $.ajax({
         url: route,
         success: function (response) {
            if(response == "Saved"){
               $(divToHide).hide();
            }
         },
         error: function (error) {
            console.log(error);
         }
      });

   });

   $(".revome_tweet").on("click", function(){

      var route = $(this).attr('route');
      var divToHide = $(this).parent().parent();

      $.ajax({
         url: route,
         success:function (response) {
            if(response == "1"){
               $(divToHide).hide();
            }
         },
         error: function(error){
            console.log(error);
         }
      })

   });

});