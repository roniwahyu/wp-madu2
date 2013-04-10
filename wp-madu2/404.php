<? get_header();?>
<div class="clear">&nbsp;</div>
	<section id="content">
		<div id="maincontent">
			<?php
				//if(is_404()&&function_exists('seo_alrp_get_404_title')){
				//	$title = seo_alrp_get_404_title();
					echo "<title>".the_title()."</title>";
					echo "<meta name=\"description\" content=\"Selamat datang di Pakarlebah.com, Ahli Lebah Madu Indonesia. Disini Anda dapat menemukan berbagai macam informasi tentang peternakan lebah madu, pengolahan madu, khasiat dan manfaat madu, dsb. saat ini anda sedang berada di halaman $title.\" />";
					echo "<meta name=\"keywords\" content=\"$title,pakar lebah indonesia\" />";
			//}
			?>
		</div>

	<div class="clear">&nbsp;</div>
	</section><div class="clear">&nbsp;</div>
<? get_footer();?>