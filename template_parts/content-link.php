<?php
	$link=grab_url();
	$output= "<div class='col-xs-12 col-sm-6 index_content'>";
	$output.="<td><a target='_blank' href='".$link."'><div class='index_thumbnail link_post_format'><div class='table text-center'><div class='table-cell'><i class='fa fa-link' aria-hidden='true'></i></div></div></div></a></td>";
	$output.="<h1 class='index_title'><a target='_blank' href='".$link."'>".get_the_title()."</a></h1>";
	$output.=get_the_excerpt();
	$output.="</div>";
	echo $output;
?>