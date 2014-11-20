<?php

	if(empty($_POST['kt_lazy_photo_gallery_hidden']))
		{
			$kt_lazy_photo_gallery_width = get_option( 'kt_lazy_photo_gallery_width' );
			$kt_lazy_photo_gallery_height = get_option( 'kt_lazy_photo_gallery_height' );
			$kt_lazy_gallery_animation = get_option( 'kt_lazy_gallery_animation' );		
		}

	else
		{
		
		if($_POST['kt_lazy_photo_gallery_hidden'] == 'Y')
			{
			//Form data sent
			$kt_lazy_photo_gallery_width = $_POST['kt_lazy_photo_gallery_width'];
			update_option('kt_lazy_photo_gallery_width', $kt_lazy_photo_gallery_width);
			
			$kt_lazy_photo_gallery_height = $_POST['kt_lazy_photo_gallery_height'];
			update_option('kt_lazy_photo_gallery_height', $kt_lazy_photo_gallery_height);
						
			$kt_lazy_gallery_animation = $_POST['kt_lazy_gallery_animation'];
			update_option('kt_lazy_gallery_animation', $kt_lazy_gallery_animation);
						
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p>
            </div>
      
            
<?php
			}
		} 
?>


<div class="wrap">
<?php echo "<h2>".__('Kento Fancy Gallery Options')."</h2>";?>

<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="kt_lazy_photo_gallery_hidden" value="Y">
        <?php settings_fields( 'kt_lazy_gallery_options_setting' );
				do_settings_sections( 'kt_lazy_gallery_options_setting' );
		?>
			<table class="form-table">
                <tr valign="top">
                    <th scope="row">Use this Shortcode:
                    </th>
                    <td style="vertical-align:middle;">
                        <input  type="text" name="light_gallery_shortcode" onClick="this.select();" size="auto" id="light_gallery-shortcode"  value ="[kt_fancy_gallery]"><br> <span style="font-size:12px;color:#22aa5d">** Use this shortcode to display lazy photo gallery **</span>
                    </td>
                </tr>
                
           		 <tr valign="top">
					<th scope="row"><label for="kt_lazy_photo_gallery_width">Width</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='kt_lazy_photo_gallery_width' placeholder="ex : 400" class='kt-lazy-gallery-width' id="kt-lazy-gallery-width" type='text' value='<?php echo $kt_lazy_photo_gallery_width; ?>' />px<br/>
<span style="font-size:12px;color:#22aa5d">select lazy photo gallery width. default width: 240px.</span>
					</td>
				</tr>
                
				<tr valign="top">
					<th scope="row"><label for="kt_lazy_photo_gallery_height">Height</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='kt_lazy_photo_gallery_height' placeholder="ex : 300" class='kt-lazy-gallery-height' id="kt-lazy-gallery-height" type='text' value='<?php echo $kt_lazy_photo_gallery_height; ?>' />px<br>
<span style="font-size:12px;color:#22aa5d">select lazy photo gallery height. default height: 180px.</span>
					</td>
				</tr>
                
           <tr valign="top">
            <th scope="row"><label for="kt_lazy_gallery_animation">Animation</label></th>
                <td style="vertical-align:middle;">
                <select name="kt_lazy_gallery_animation">
                <option value="bounce" <?php if($kt_lazy_gallery_animation=='bounce') echo "selected"; ?> >bounce</option>
                <option value="flash" <?php if($kt_lazy_gallery_animation=='flash') echo "selected"; ?> >flash</option>
                <option value="pluse" <?php if($kt_lazy_gallery_animation=='pluse') echo "selected"; ?> >pluse</option>
                <option value="rubberBand" <?php if($kt_lazy_gallery_animation=='rubberBand') echo "selected"; ?> >rubberBand</option>
                <option value="shake" <?php if($kt_lazy_gallery_animation=='shake') echo "selected"; ?>>shake</option>
                <option value="swing" <?php if($kt_lazy_gallery_animation=='swing') echo "selected"; ?>>swing</option>
                    
                </select><br>
               		<span style="font-size:12px;color:#22aa5d">Use Dropdown Menu to select lazy photo gallery animation.default animation:none.</span>
                </td>
		   </tr> 

			</table>
                <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>

</form>

<br><br><br><br>
<div class="wrap">
	<table class="form-table">	
             <tr valign="top">
                <th>Like Us On:</th>
               <td><a target="_blank" href="https://www.facebook.com/kentostudios">Facebook</a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="https://twitter.com/kentothemes">Twitter</a></td>
            </tr>
             <tr valign="top">
             	<th>If you need support don't hesitate to ask us:</th>
               <td><a target="_blank" href="http://kentothemes.com/question_answers/"> KentoThemes Q&A</a>
               </td>
            </tr>            
	</table>
</div>










			<script>
            jQuery(document).ready(function(jQuery)
                {	
                jQuery('#light-gallery-option-color').wpColorPicker();
                });
            </script> 

</div>