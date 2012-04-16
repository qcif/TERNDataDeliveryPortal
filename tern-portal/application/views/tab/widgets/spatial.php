<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
function checkForInvalid(obj) {
	if( /[^0-9\-\.]|-{2,}/gi.test(obj.value) ) {
		alert("Invalid character in coordinates")
		obj.focus();
		obj.select();
		return false;
	}
	return true;
}

</script>

<div id="advance-spatial-search">
            
    <div id="spatial-search-tab">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td></td>
                <td><label class="spatial-label">N:</label><input class="search-input-mini" id="spatial-north" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                <td></td>                
            </tr>
            <tr>
                <td><label class="spatial-label">W:</label><input class="search-input-mini" id="spatial-west" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                <td></td>
                <td><label class="spatial-label">E:</label><input class="search-input-mini" id="spatial-east" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
            </tr>
            <tr>
                <td></td>
                <td><label class="spatial-label">S:</label><input class="search-input-mini" id="spatial-south" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                <td></td> 
            </tr> 
        </table>
    </div>
            <div class="clearfix"></div>
</div>