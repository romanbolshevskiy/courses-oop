
/*slider recommends courses*/
size = $(".slider .item").size();
x=3;
if(size <=x) {$('#next').hide();}
$('.slider .item:lt('+ (x) +')').css('display','inline-block');

if(x-3<=0){
    $('#prev').hide();
}
$('#next').click(function () {
    if(x+3 < size){
        x=x+3;
        $('.slider .item:lt('+x+')').css('display','inline-block');
        $('.slider .item:lt('+ (x-3) +')').hide(0);
    }
    else{
        y=size-x;
        x=x+3;
        $('.slider .item:lt('+ (size) +')').css('display','inline-block');
        $('.slider .item:lt('+(size-y)+')').hide(0);
        $(this).hide(0);
    }
    $('#prev').show();
});

$('#prev').click(function () {
    if(x-3<=3){
        x=x-3;
        $(this).hide(0);
    }
    else{
        x=x-3;      
    }
    $('.slider .item').not(':lt('+(x-3)+')').css('display','inline-block');
    $('.slider .item').not(':lt('+(x)+')').hide();
    $('#next').show();
});

/*slider bests teachers*/

size2 = $(".slider2 .item").size();
x2=3;
if(size2 <=x2) {$('#next2').hide();}
$('.slider2 .item:lt('+ (x) +')').css('display','inline-block');

if(x2-3<=0){
    $('#prev2').hide();
}
$('#next2').click(function () {

    if(x2+3 < size2){
        x2=x2+3;
        $('.slider2 .item:lt('+x2+')').css('display','inline-block');
        $('.slider2 .item:lt('+ (x2-3) +')').hide();
    }
    else{
        y=size2-x2;
        x2=x2+3;
        $('.slider2 .item:lt('+ (size2) +')').css('display','inline-block');
        $('.slider2 .item:lt('+(size2-y)+')').hide();
        $(this).hide(0);
    }
    $('#prev2').show();
});

$('#prev2').click(function () {
    if(x2-3<=3){
        x2=x2-3;
        $(this).hide(0);
    }
    else{
        x2=x2-3;      
    }
    $('.slider2 .item').not(':lt('+(x2-3)+')').css('display','inline-block');
    $('.slider2 .item').not(':lt('+(x2)+')').hide();
    $('#next2').show();
});



/*        add to cart         */
$(document).ready(function(){
    $('.add-to-cart').click(function(){
        var count = $("#cart-count").text();
        if(!count){
            $("#cart-count").text(1);
        }
        else{
            $("#cart-count").text(parseInt(count)+1);
        }
        $(this).parent().html("<span style='color:orange;'>Added already</span>");
       
        $(this).hide();
        var data = {
            idc : $(this).attr("data-idc"),
            idu : $(this).attr("data-idu"),
            name : $(this).attr("data-name"),
            url : $(this).attr("data-url"),
            price : $(this).attr("data-price")
        }

        $.ajax({
            url : "/addCart/",
            data : data,
            method: "POST",
            success: function(data){
                console.log('good');
                alert('Added');        
            },
            error: function(data){
              console.log(data);
              alert("Error");
            }
         }).done(function() {
              console.log("Done.");
              //$(".add-to-cart").hide();
                //$(this).
            });

        return false;
    });


    /*        delete order detail        */

    // $('.delete_detail').click(function(){
    //     //$(this).parent().html("<span style='color:orange;'>Added already</span>");
    //     //$(this).hide();
    //     $(this).parent(".blok").parent(".contents").hide();       

    //     var data = {
    //         idod : $(this).attr("data-idod")
    //     }
    //     $.ajax({
    //         url : "/deleteDetail/",
    //         data : data,
    //         method: "POST",
    //         success: function(data){
    //             console.log('good');
    //         },
    //         error: function(data){
    //           console.log(data);
    //           alert("Error");
    //         }
    //      }).done(function() {
    //           console.log("Done.");
    //         });

    //     return false;
    // });

});


