   <div ID = "toTop" >Наверх</div>
      <?php wp_footer(); ?>

<div class="footer">

	<div class="logo-footer">
		<img src="<?php bloginfo("template_directory"); ?>/images/logo-footer.png" alt="">
	</div>
	<div class="info-footer">
		<div class="address">г. Новосибирск, Каменская ул. 52 корпус 3</div>
		<div class="telephone">Тел.: (383) 2-110-500</div>
	</div>
	
</div>

<script src="<?php bloginfo("template_directory"); ?>/js/jquery-2.1.1.js"></script>
<script src="<?php bloginfo("template_directory"); ?>/js/main.js"></script>
<script src="<?php bloginfo("template_directory"); ?>/js/scroll.js"></script>

<script type="text/javascript">
 
$(function() {
 
$(window).scroll(function() {
 
if($(this).scrollTop() != 0) {
 
$('#toTop').fadeIn();
 
} else {
 
$('#toTop').fadeOut();
 
}
 
});
 
$('#toTop').click(function() {
 
$('body,html').animate({scrollTop:0},800);
 
});
 
});
 
</script>
</body>
</html>
