$(document).ready(function()
  {

      $('#signup-form').submit(function(event)
        {

          var id = $('#id').val();
          var fname = $('#fname').val();
          var lname = $('#lname').val();
          var password = $('#password').val();
          var confirm = $('#confirm').val();

          if(!validateId(id))
          {
          	alert("Username must start with an english alphabet(A-Z or a-z).");
          	return false;
          }
          if(!(validateName(fname)||validateName(lname)))
          {
          	alert("Name must contain only english alphabets.");
          	return false;
          }

          if(password !== confirm)
          {
            alert("Password field mismatch.");
            return false;
          }
          else
          {
            alert("done");
          }

          
        });
      
      

      function validateId(id)
      {
			return /[a-z|A-Z]/.test(id[0]);
      }

      function validateName(name)
      {
      		return /^[a-z|A-Z]+$/.test(name);
      }

  });
