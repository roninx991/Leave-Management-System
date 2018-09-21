if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    var xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.open("GET","leaveapp.xml",false);
  xmlhttp.send();
  xmlDoc=xmlhttp.responseXML;
  var x=xmlDoc.getElementsByTagName("applications");
  var str="<table border=\"5px\"><th>Roll No.</th><th>Name</th><th>Class</th><th>Attendance</th><th>Action</th>";
 for (i=0;i<x.length;i++)
  { 
    str+="<tr><td>";
    str+=x[i].getElementsByTagName("Roll")[0].childNodes[0].nodeValue;
    str+="</td><td>";
    str+=x[i].getElementsByTagName("Name")[0].childNodes[0].nodeValue;
    str+="</td><td>";
    str+=x[i].getElementsByTagName("Class")[0].childNodes[0].nodeValue;
    str+="</td><td>";
    str+=x[i].getElementsByTagName("Attendance")[0].childNodes[0].nodeValue;
    str+="</td><td>";
    str+="<a href=\"www.google.com\">View</a>/<a href=\"www.pict.edu\">Approve</a></td>";
    str+="</tr>";
  }
  str+="</table>";
  document.getElementById("tab").innerHTML=str;