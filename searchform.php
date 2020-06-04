<!-- This page is not called by any page. its is a default page name for
 wordpress. the markup class -->
<!---->
<form id="search_form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<input type="search" class="form-control" placeholder="Search" value="<?php echo get_search_query() ?>" name="s" title="Search" />
</form>
