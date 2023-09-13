@php
    use Illuminate\Support\Facades\Session;
    $message =[];
     if (Session::has('message_status')){
            $message = [
                     'text' => Session::get('message'),
                     'type' => Session::get('message_status'),
            ];
     }
@endphp
@if(!empty($message))
    <script>
        toastr.{{$message['type']}}('{{$message['text']}}')
    </script>
@endif

