<form role="search" method="get" class="search-form w3-section" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text"><b><?php echo _x( 'Search for:', 'label' ) ?></b></span>
        <input type="search" class="search-field w3-input w3-border w3-margin-bottom"
            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <input type="submit" class="search-submit w3-input w3-border w3-hover-grey" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>
