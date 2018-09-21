function submitDate() {
	var radios = document.getElementsByName('dtype');
	var dt= document.getElementById('dt').value;
	var writeTo = document.getElementById('dol');

	for (var i = 0, length = radios.length; i < length; i++)

	{
		if (radios[i].checked)
		{
			if(radios[i].value==="half"){
				writeTo.value += dt+" - "+"Half Day\n";
				break;
			}
			if(radios[i].value==="full"){
				writeTo.value += dt.toString()+" - "+"Full Day\n";
				break;
			}
				  // only one radio can be logically checked, don't check the rest
		}
	}
}
function viewApp(obj) {
	var id = obj.getAttribute("id");
	window.location.href = "../../php/viewStudApp.php?id="+id;
}