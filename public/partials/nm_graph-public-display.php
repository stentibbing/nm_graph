<?php
/**
 * Provide a public-facing view for the plugin
 */
?>

<?php ob_start(); ?>
  <div class="amchart">
    <div id="nm-graph-amchart"></div>
    <div id="nm-graph-legend">
      <ul id="legend"></ul>
    </div>
  </div>
<?php return ob_get_clean(); ?>




