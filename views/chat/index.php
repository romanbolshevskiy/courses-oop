<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-10 col-sm-offset-1 padding-right">
                <div class="chat">
                    <div style="padding: 2%;">
                        <h1>Php Ajax Chat</h1>
                        
                        <form method="post" id="pac_form" action="">
                           <table style="width: 100%;" border="1">
                                <tr>
                                    <td>Name:</td>
                                    <td>Message:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="pac_name" name="name" class="r4" value="<?php echo $user; ?>"></td>
                                    <td style="width: 80%;"><input name="text" type="text" id="pac_text" class="r4" value=""></td>
                                    <td><input type="submit" name="submit"  value="Send"></td>
                                </tr>
                            </table>
                        </form>
                        <div class="chat r4">
                            <div id="chat_area">chat_area</div>
                        </div>
                    </div>
                </div>
                
                <script type="text/javascript">
                    $(document).ready(function () {
                        $("#pac_text").val();
                        $("#pac_text").focus();
                        Load();

                        $("#pac_form").submit(function(e) {
                            if($("#pac_text").val()==="") {
                                alert("Error!Empty field");
                                return false;
                            }
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url : "/chat/", 
                                cache: false,  
                                data: $(this).serialize(),
                                error: function(data){
                                    console.log("Error");
                                },
                                success: function(data){
                                    console.log(data);
                                }}).done(function() {
                                   $("#pac_text").val('');
                                });                        
                            return false;
                            });

                        // SSE
                        if (typeof(EventSource) !== 'undefined') {
                            var source = new EventSource('/update-chat/');
                            source.onmessage = function(event) {
                                if (length != event.data){
                                    Load();
                                }
                            };
                        }
                    });

                    var length;
                    function Load() { //витягуються дані  аяксом з адреси!
                        $.ajax({
                            type: "POST",
                            url : "/get-messages/", 
                            dataType: "json",
                            success: function(messages){
                                $("#chat_area").empty();
                                length =messages.length;
                                for (var i = 0; i < length ; i++) {
                                    $("#chat_area").append("<p><span><b>"+ messages[i]['name'] +"</b></span>: </span><span><b> "+ messages[i]['message'] +"</b></span><span class='right'>( "+ messages[i]['date'] +" )</span></p>");
                                }
                            }
                        });        
                    }
                </script>   
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>