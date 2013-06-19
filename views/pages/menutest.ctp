<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric', 'ui/uiSmartSearch', 'jquery-contextMenu'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch', 'context/jquery-contextmenu'));
?>
<script>
$(document).ready(function(){
$(function(){
    $.contextMenu({
        selector: '.context-menu', 
        callback: function(key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m); 
        },
        items: {
            "edit": {name: "Clickable", icon: "edit"},
            "cut": {
                name: "Cut", 
                icon: "cut", 
                disabled: function(key, opt) { 
                    // this references the trigger element
                    return !this.data('cutDisabled'); 
                }
            },
            "toggle": {
                name: "Toggle", 
                callback: function() {
                    // this references the trigger element
                    this.data('cutDisabled', !this.data('cutDisabled'));
                    return false;
                }
            }
        }
    });
});
});
</script>
<div class="context-menu">
		<strong>with data title</strong>
</div>