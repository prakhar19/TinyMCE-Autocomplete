<style>#warn{margin-top:15px;}#tb{margin-top:40px;font-size:16px;width:100%;}#tb .head-opt{width:60%;padding:10px 0;}#tb .value-opt{padding-left:25px;}</style>

<div class="wrap">
<h1>Autocomplete</h1>
<div id="warn"><strong style="color:red;">Note:</strong> These settings will will be locally saved to your device, and would only be available to you.</div>
<div id="warn"><strong style="color:red;">Note:</strong> Settings will save as soon as you change them. Reload the post editor to see changes.</div>

<table id="tb">
	<tr>
		<td class="head-opt">Press <strong>Enter</strong> to accept suggestion</td>
		<td class="value-opt"><input type="checkbox" id="enter-opt" checked onclick="setopt('enter', this.checked)"/></td>
	</tr>
	<tr>
		<td class="head-opt">Press <strong>Tab</strong> to give alternate suggestions</td>
		<td class="value-opt"><input type="checkbox" id="tab-opt" checked onclick="setopt('tab', this.checked)"/></td>
	</tr>
</table>

</div>

<script>
var options = {enter:true, tab:true};

function setStorage() {
	localStorage.setItem('tinymce_autocomplete_options', JSON.stringify(options));
}

function setopt(prop, value) {
	options[prop] = value;
	setStorage();
}

if (typeof(Storage) !== 'undefined') {
    if(localStorage.getItem('tinymce_autocomplete_options') != null)
		options = JSON.parse(localStorage.getItem('tinymce_autocomplete_options'));
	else
		setStorage();
}

for(var p in options)
	document.getElementById(p+'-opt').checked = options[p];

</script>