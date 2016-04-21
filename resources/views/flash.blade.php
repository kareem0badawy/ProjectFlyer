@if(session()->has('flash_message'))

    <script>
      
      swal({
         title: "info!",
         text: "Here's my error message!",
         type: "info",
         timer: 2000,
         showConfirmButton: false,

          });
    
    </script>

@endif