	<div class="container">

    <?php
	global $wpdb;
        $images = get_post_meta( get_the_ID(), 'madu_image', false );
        if($images):
            $images = implode( ',' , $images );
        //echo var_dump($images);
        // Re-arrange images with 'menu_order'
        $images = $wpdb->get_col( "
            SELECT ID FROM {$wpdb->posts}
            WHERE post_type = 'attachment'
            AND ID in ({$images})
            ORDER BY menu_order ASC
        " );

            ?>
        <div class="row">
            <div class="span4">
                           <?php if(has_post_thumbnail()):

                                the_post_thumbnail('product-image',array('class'=>'image allrounded','style'=>'vertical-align:center'));

                            endif; ?> 
                <ul class="thumbnails small">   

        <?php
        foreach ( $images as $att ){
            // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
            $src = wp_get_attachment_image_src( $att, 'product-thumb' );
            $src = $src[0];

            // Show image
           
            echo "<li class='span1'><a href='".$src."' class='colorbox' data-fancybox-group='group1' title='Description 1' ><img style='width:auto;height:auto' class='thumb' src='".$src."' title='' /></a></li>";
            
        }	
            echo "</ul></div>";
	
	?>

                             
                      <div class="span4">
                            <address>
                                <strong>Brand:</strong> <span>Apple</span><br>
                                <strong>Product Code:</strong> <span>Product 14</span><br>
                                <strong>Reward Points:</strong> <span>0</span><br>
                                <strong>Availability:</strong> <span>Out Of Stock</span><br>                                
                            </address>
                            <h4><strong>Price: $587.50</strong></h4>
                        </div>
                        <div class="span5">
                            <form class="form-inline">                              
                                <label>Qty:</label>
                                <input class="span1" placeholder="1" type="text">
                                <button class="btn" type="submit">Add to cart</button>
                            </form>
                        </div>
                        <div class="span5">
                            
                        </div>
                    </div>
    <?php endif;?>
</div>