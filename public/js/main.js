
/* niceScroll */
$(document).ready(function() {
    var current;
    $("#discountOption").change(function(){
        if($("#discountOption").prop('checked') == false)
        {
            $(".discountvalue").fadeOut(400);
        }
        if($("#discountOption").prop('checked') == true)
        {
            $(".discountvalue").fadeIn(400);
            // current = parseInt($("#RequireMoney").text());
        }
    })

    $("#discountinput input").keyup(function () {
        var discount = parseInt($(this).val());
        if (discount < current && discount != "") {
            var total = current - discount;
            $("#RequireMoney").text(total);
        }
        else
            $("#RequireMoney").text(current);
    });
});
/* niceScroll */
/* ------------------------------- */

/* navbar-scroll */
     $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {
            $("nav").css({
                "background": "#5356a5",
                "padding-top": "5px",
                "padding-bottom": "5px",
                "border-bottom": "2px solid #5356a5",
            });

        } else {
            $("nav").css({
                "background": "none",
                "padding-top": "20px",
                "padding-bottom": "20px",
                "border-bottom": "none"
            });

        }
    })

/* navbar-scroll */
/* ------------------------------- */
   
/* stop carousel */
	$('.carousel').carousel({
    	interval:false
	});
/* stop carousel */
/* ------------------------------- */

/* popup */
function closePopup()
{
    $(".popup").delay(50).fadeOut(300,function(){
        $(".background").fadeOut(300);
        $(".popup .alert").fadeOut(300);
        $(".popup input[type!='hidden'] , textarea").val("");
    })
}
$(".background").click(function(){
    closePopup();
    });

       $(".popup .no , .popup i.fa-close").click(function(){
           closePopup();
       });
$(document).on('click','*',function(){
        if(this.hasAttribute('data-popup'))
            {
            var popup = $(this).attr("data-popup");
                if(this.hasAttribute("data-img"))
                {
                    var image = $(this).attr("src");
                    $("#"+popup+" .popup-content img").attr("src",image);
                }
           $(".popup").fadeOut(300,function(){
            $(".background").fadeIn(300,function(){
            $("#"+popup).fadeIn(300);
        })
        })            
            }
 
    });

/* popup */
/* ------------------------------- */

/* loading */
$(window).on('load',function () {
    $(".cssload-loader").fadeOut(800, function () {
        $("body").css("overflow", "auto");
        $(".loading").fadeOut(function () {
            $(this).remove();
        });
    });

});
/* loading */ 
/* ------------------------------- */