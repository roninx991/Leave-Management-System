$(document).ready(function()
  {
      function validateId(id)
      {
			return /[a-z|A-Z]/.test(id[0]);
      }

      function validateName(name)
      {
      		return /^[a-zA-z ]+$/.test(name);
      }

  });