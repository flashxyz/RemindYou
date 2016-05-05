	<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/flashxyz/BookMe/wiki
 * @since      1.0.0
 *
 * @package    Wp_book_me
 * @subpackage Wp_book_me/admin/partials
 */




global $wpdb;


$tablename_options = $wpdb->prefix . "bookme_test_options";


$selectSQL = $wpdb->get_results( "SELECT * FROM $tablename_options ORDER BY id ASC" );

$siteURL = get_site_url()."/wp-admin/admin.php";

?>

<script type="text/javascript">

var siteURL = <?php echo json_encode($siteURL);?>;

function checkMe(arg) {

var del = arg;

    if (confirm("Are you sure you want to delete this rooms group (id "+ del +")? All settings will be irrevocable deleted.")) {
        //alert("Clicked Ok");
		//confirmForm(); 
		//fDeleteFieldAndData(del);
		//e.preventDefault();
		//window.location.href = '?page=contest-gallery/index.php&delete=true&option_id='+del+'';
		window.location.replace(siteURL+'?page=wp_book_me&delete=true&option_id=' + del +'');
	    return true;
    } else {
        //alert("Clicked Cancel");
        return false;
    }
}

</script>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<hr>
	<br>
    <div class="main-table">
    
    
    	<?php foreach($selectSQL as $value)
    		{

				$option_id = $value -> id;
			
				if ($option_id % 2 != 0) 
				{
					$backgroundColor = "#DFDFDF";
				} 
				else 
				{
					$backgroundColor = "#ECECEC";
				}    ?>

				<table width='635px' style='border: 1px solid #DFDFDF;background-color:#ffffff;'>
				<tr style='background-color:#ffffff;'>
				<td style='padding-left:20px;width:100px;' ><p>Group ID: <?php echo $option_id ?> </p></td>
				<td align='center'><p>Shortcode: <strong>[bk_rooms_group id="<?php echo $option_id ?>"]</strong></p></td>
				<td align="center"><p><form action="?page=wp_book_me&option_id='<?php echo $option_id ?>'" method="POST" ><input type="hidden" name="option_id" value="<?php echo $option_id ?>">
				<input type="hidden" name="page" value="wp_book_me"><input name="" value="Edit" type="Submit" class="button-secondary" style = "background-color:#BBEEAA;"></form></p></td>
				<td align="center"><p><form action="?page=wp_book_me" method="get" ><input type="hidden" name="option_id" value="<?php echo $option_id ?>">
				<input type="hidden" name="delete" value="true"><input type="button" onClick="return checkMe(<?php echo $option_id ?>)" value="Delete" class="button-secondary" style = "background-color:#FF8181;"></form></p></td>



				</tr>
				</table>

		<?php 
		@$option_id++;
		} 
		?>

    <br/>

    <?php 
    	$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename_options'");
			$nextID = $last->Auto_increment;
	?>

	<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='635px'>
	<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><form action="?page=wp_book_me&option_id=<?php echo $nextID ?>&edit_group=true&create_group=true" method="POST" ><input type="hidden" name="option_id" value="<?php echo $nextID ?>">

	<input type="hidden" name="create" value="true"><input type="hidden" name="page" value="wp_book_me"><input name="" value="Create New Rooms Group" type="Submit" class="button-primary"></form></p></td></tr>
	</table>


</div>