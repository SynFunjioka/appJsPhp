$.ajax(
    {
        url: './php/app.php',
        data:{
            action: 'connect'
        },
        type: 'GET',
        // contentType: false,
        dataType: "json",
        // cache: false,
        // processData: false,
        success: function(data) {
          alert('AJAX call was successful!');
          console.log(data);
        },
        error: function() {
          alert('There was some error performing the AJAX call!');
        }
     }
  );