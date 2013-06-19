
<?php
echo $this->Html->css(array('ui/uiTextDisplay','ui/uiCollapsible','ui/uiMetrics','active/hot_button'));
echo $this->Html->script(array('ui/uiCollapsible','cache_break','active/hot_button'));
?>
<input type="button" value="Mon" class="hot_button skinless neat"/>
<input type="button" value="Tue" class="hot_button skinless neat"/>
<input type="button" value="Wed" class="hot_button skinless neat"/>
<input type="button" value="Thu" class="hot_button skinless neat"/>
<input type="button" value="Fri" class="hot_button skinless neat"/>
<?php echo $this->element('activity_feed');?>
