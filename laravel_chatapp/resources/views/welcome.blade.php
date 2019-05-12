<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App With Socket and Laravel</title>
    </head>
    <body>
       <h1>New Users</h1>

        <div id="msg_box">
           <ul id='show'>
                
           </ul>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
         <script type="text/javascript">
          var socket = io('http://127.0.0.1:3000');  

          $(document).ready(function(){

            socket.on('test-channel:App\\Events\\UserSignedUp', function(data) {
                console.log(data)
                $("#show").html($("#show").html() +"<li>"+data.username+"<p>"+data.role+"</p><p>"+data.age+"</p></li>");
            });
          });

         </script>
    </body>
</html>
