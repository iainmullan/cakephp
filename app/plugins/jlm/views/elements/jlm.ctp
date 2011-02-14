<!-- JQuery Light MVC -->
<?php
	$cachedCopy = APP.'webroot/js/jlm/jlm.js';
	if (is_file($cachedCopy)) {
		$jlmPath = Router::url('/js/jlm/jlm.js');
	} else {
		$jlmPath = Router::url('/jlm/assets/jlm');
	}
?>
<script type="text/javascript" src="<?php echo $jlmPath; ?>"></script>
<script type="text/javascript">
//<![CDATA[
    $.jlm.config({
        base: '<?php echo $this->base ?>',
        controller: '<?php echo $this->params['controller'] ?>',
        action: '<?php echo $this->params['action'] ?>'
    });

    $(function() {
       $.jlm.dispatch();
    });
//]]>
</script>