<?php
global $ttso;
$searchbartext = stripslashes($ttso->st_searchbartext);
?>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
			        <div class="bgsearch">
			          <input type="text" name="s" id="s2" value="<?php echo $searchbartext; ?>" onFocus="if (this.value == '<?php echo $searchbartext;?>')this.value = '';" onBlur="if (this.value == '')this.value = '<?php echo $searchbartext;?>';" />
			          <input type="submit" class="searchbutton" value="" />
			        </div>
    			 </form>