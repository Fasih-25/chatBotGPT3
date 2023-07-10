<!DOCTYPE html>
<html>
<head>
    <title>Chatbot</title>
    <link href="Libraries/bootstrap-5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="Libraries/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="Libraries/bootstrap-5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-between ">
        <div class="d-flex main card w-100 justify-content-between">
            <div class="card-header bg-info ">
                <h1 class="fw-bold text-center " >OsceBot</h1>
            </div>
            <div class="d-flex  flex-column ">
                    <div id="chatbox" class="chatbox"> 
                    </div>
                <div>
                    <form id="chat-form" class="d-flex py-2">
                        <input type="text" id="message-input" class="form-control mx-1 " placeholder="Type your message..." />
                        <button type="submit" class=" btn btn-primary mx-1">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#chat-form').submit(function(e) {
                e.preventDefault();
                var message = $('#message-input').val();

                if (message !== '') {
                    $('#chatbox').append('<div class="message user p-3 ms-5 me-1 mb-2 mt-1" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);" >' + message + '</div>');
                    $('#message-input').val('');

                    $.post('chatbot.php', { message: message }, function(response) {
                        $('#chatbox').append('<div class="message bot p-3 me-5 ms-1 mb-1 border" style="border-radius: 15px; background-color: #fbfbfb;">' + response + '</div>');
                    }); 
                    down()
                }
                
            });
            var scrolled = 0;
                function down()
                {
                    var chatbox = document.getElementById('chatbox');
                    scrolled = chatbox.scrollHeight;
                    $( "#chatbox" ).animate({
                    scrollTop :  scrolled
                    });
            
                }
        });
        
    
    </script>
</body>
</html>