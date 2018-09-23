@if(\Illuminate\Support\Facades\Session::has('flash_message'))
      <script>
        swal({
            title:"{{Session::get('flash_message')}}",
            text: "  هذه الرسالة سوف تختفى بعد 4 ثانية",
            timer:4000,
            showConfirmButton: false
        });

    </script>


@endif