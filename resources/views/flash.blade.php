@if(session()->has('flash_message'))

    <script>
      
      swal({
         title: "{{ session('flash_message.title') }}",
         text: "{{ session('flash_message.message') }}",
         type: "success",
         timer: 2000,
         showConfirmButton: false,

          });
    
    </script>

@endif