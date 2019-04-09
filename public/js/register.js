window.onload = function(){
  var form = document.getElementById('signup');

  var first_pass = form.pwd;
  var second_pass = form.pwdconfirm;

  var validatePassword = function(){
    if (first_pass.value === second_pass.value) {
      first_pass.setCustomValidity('');
    } else {
      first_pass.setCustomValidity('The two passwords must match. ');
    }
  };

  first_pass.onchange = validatePassword;
  second_pass.onchange = validatePassword;

  var first_email = form.email;
  var second_email = form.emailconfirm;

  var validateEmail = function(){
    if (!first_email.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
      first_email.setCustomValidity('Please enter a valid e-mail address.');
    }
    else if (first_email.value === second_email.value) {
      first_email.setCustomValidity('');
    } else {
      first_email.setCustomValidity('The two emails must match. ');
    }
  };

  first_email.onchange = validateEmail;
  second_email.onchange = validateEmail;

};