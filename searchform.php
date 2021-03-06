<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

  <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="assistive-text hidden"><?php _e( 'Search', 'mars' ); ?></label>
    <input type="text" value="<?php echo get_search_query(); ?>" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'mars' ); ?>" />
    <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mars' ); ?>" />
  </form>
