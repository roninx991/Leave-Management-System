function submitDate() {
	var radios = document.getElementsByName('day');
	var dt= document.getElementById('dt').value;
	var writeTo = document.getElementById('writeTo');

	for (var i = 0, length = radios.length; i < length; i++)

	{
		if (radios[i].checked)
		{
			if(radios[i].value==="half"){
				alert(radios[i].value);
				writeTo.value += dt+" - "+"Half Day\n";
				break;
			}
			if(radios[i].value==="full"){
				alert(radios[i].value);
				writeTo.value += dt.toString()+" - "+"Full Day\n";
				break;
			}
				  // only one radio can be logically checked, don't check the rest
		}
	}
}
