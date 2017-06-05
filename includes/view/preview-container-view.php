<?php
$option           = get_option( BBPLP_SETTINGS );
$preview_type     = isset( $option['preview_type'] )     ? $option['preview_type'] : '';
$preview_size     = isset( $option['preview_size'] )     ? $option['preview_size'] : '';
$preview_height   = isset( $option['preview_height'] )   ? $option['preview_height'] : '';
$preview_width    = isset( $option['preview_width'] )    ? $option['preview_width'] : '';
$default_css      = isset( $option['use_default'] )      ? $option['use_default'] : '';
$border_type      = isset( $option['border_type'] )      ? $option['border_type'] : '';
$border_width     = isset( $option['border_width'] )     ? $option['border_width'] : '';
$border_color     = isset( $option['border_color'] )     ? $option['border_color'] : '';
$padding          = isset( $option['padding'] )          ? ' padding: ' . $option['padding'] . ';' : '';
$background_color = isset( $option['background_color'] ) ? ' background-color: ' . $option['background_color'] . ';' : '';
$border           = ( $border_type != 'none' )           ? ' border: ' . $border_width . ' '. $border_type . ' ' . $border_color . ';' : '';
$size             = ( $preview_size == 'custom' )        ? ' width: ' . $preview_width . '; height: ' . $preview_height . ';' : '';
$styles           = ( $default_css == 1 )                ? $background_color . $border . $padding . $size : '';
$heading          = ( $preview_type == 'inline' )        ? '<p id="bbplp-heading" class="bbplp-heading">Preview:</p>' : '';
?>
<?php echo $heading; ?>
<div id="bbplp-preview-content" class="bbplp-preview-content" style="<?php echo $styles; ?>">
</div>