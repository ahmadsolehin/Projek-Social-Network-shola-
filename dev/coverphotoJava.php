  <script type="text/javascript">

      var usertype = '<?php echo $usertype; ?>';
      var background = '<?php echo $background; ?>';
      var position = '<?php echo $position; ?>';

       var simple = '<?php echo $fn; ?>';
           simple += '<?php echo $ln; ?>';


    if (usertype == "Service Provider") 
    {
        var path = 'user_provider/';
        path+=simple;
        path+='/'+background;

    }else if (usertype == "Service Seeker") {

        var path = 'user_seeker/';
        path+=simple;
        path+=background;
    };





       $(function() {
      $(".full-background").CoverPhoto({
      currentImage: path,
      editable: true
      });

            $(".full-background").bind('coverPhotoUpdated', function(evt, dataUrl) {

   var pos =  $(".coverphoto-photo-container").children().position(); // returns an object with the attribute top and left
   
               $.ajax({
          type:'post',
        url: 'juju.php',
        data: {
          'name':dataUrl,
          'position':pos.top
        },
        success: function(data){
     //      alert(data);
        }
    });
               

      });

    });

    



   
  </script>