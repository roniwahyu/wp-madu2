$.fn.getIndex=function(){var a=$(this).parent().children();return a.index(this)};$.fn.portfolioInit=function(){$(this).each(function(){$(this).hover(function(){$(this).find(".hover_content:first").fadeIn()},function(){$(this).find(".hover_content:first").fadeOut()})});$(this).click(function(){$(this).find("a:first").click();return false});$(".portfolio_vimeo").fancybox({padding:10,overlayColor:"#000000",overlayOpacity:0.7});$(".portfolio_youtube").fancybox({padding:10,overlayColor:"#000000",overlayOpacity:0.7});$(".portfolio_image").fancybox({padding:0,overlayColor:"#000000",overlayOpacity:0.7})};$(function(){$(".nav li a").each(function(){$(this).click(function(){$(".nav li a").removeClass("selected");$(".popup").css("display","none");$(this).addClass("selected");var c=$(this).parent().find(".popup");if(c.length>0){var f=$(this).parent().offset();var d=$(this).parent().width();var e=f.left-80+(d/2)+1;c.css({left:e+"px",top:f.top+45+"px"});c.show();return false}})});$(document).click(function(){$(".popup").css("display","none");$(".popup").parent().find("a").removeClass("selected")});$(".testimonials_owner li a").each(function(){$(this).click(function(){var c=$(this).parent().getIndex();$("#testimonials_triangle").animate({backgroundPosition:(c*95)+45+"px 0"},300);$(".testimonials p").hide();$($(this).attr("href")).fadeIn();return false})});$("#img_slider").nivoSlider({directionNav:true,pauseTime:2000,captionOpacity:0.5});var b={duration:800,adjustHeight:false,easing:"easeInOutQuad",useScaling:false};var a=$(".portfolio_container ul.portfolio_photos").clone();$("ul.portfolio_tab li").click(function(d){$("ul.portfolio_tab li").removeClass("active");var f=$(this).attr("class").split(" ").slice(-1)[0];if(f=="all"){var c=a.find("li")}else{var c=a.find("li[data-type="+f+"]")}$(".portfolio_container ul.portfolio_photos").quicksand(c,b,function(){$("ul.portfolio_photos li .wrapper").portfolioInit()});$(this).addClass("active");return false});$(".portfolio_one_column .image").hover(function(){$(this).parent().find(".hover_content").fadeIn();$(this).click(function(){$(this).find("a").click()})},function(){$(this).parent().find(".hover_content").fadeOut()})});$(document).ready(function(){$("ul.portfolio_photos li .wrapper").portfolioInit();$("#nav_skin li a").click(function(){var b=$(this).attr("href").substr(1);$.cookie("skin",b);location.href=location.href;return false});var a=setInterval(function(){if($("#slide_nav a.active").next().length>0){var c=$("#slide_nav a.active").next();var b=$("#slide_nav a.active").next().attr("href");$("#content_slider").children("div").removeClass("active_slide");$("#content_slider").children("div").css("display","none");$("#content_slider").children("div"+b).addClass("active_slide");$("#content_slider").children("div"+b).fadeIn();$("#slide_nav a").removeClass("active");c.addClass("active")}else{var b=$("#slide_nav a:first-child").attr("href");$("#content_slider").children("div").removeClass("active_slide");$("#content_slider").children("div").css("display","none");$("#content_slider").children("div"+b).addClass("active_slide");$("#content_slider").children("div"+b).fadeIn();$("#slide_nav a").removeClass("active");$("#slide_nav a:first-child").addClass("active")}},3000);$("#slide_nav a").click(function(){var b=$(this).attr("href");$("#content_slider").children("div").removeClass("active_slide");$("#content_slider").children("div").css("display","none");$("#content_slider").children("div"+b).addClass("active_slide");$("#content_slider").children("div"+b).fadeIn();$("#slide_nav a").removeClass("active");$(this).addClass("active");clearInterval(a);return false});$.preloadCssImages();$.validator.setDefaults({submitHandler:function(){var b=$("#contact_form").attr("action");$.ajax({type:"POST",url:b,data:$("#contact_form").serialize(),success:function(c){$("#contact_form").hide();$("#reponse_msg").html(c)}});return false}});$("#contact_form").validate({rules:{your_name:"required",email:{required:true,email:true},message:"required"},messages:{your_name:"Please enter your name",email:"Please enter a valid email address",agree:"Please enter some message"}})});