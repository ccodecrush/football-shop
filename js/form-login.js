const passwordField = document.getElementById("pwd");
const confirmPasswordField = document.getElementById("conf_pwd");

const togglePassword = document.querySelectorAll(".password-toggle-icon i");

togglePassword.forEach(icon => {
  icon.addEventListener("click", function () {
    const isPasswordField = this.closest('.password-toggle-icon').parentElement.querySelector('input') === passwordField;

    if (isPasswordField) {
      if (this.classList.contains("fa-eye")) {
        passwordField.type = "text";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
      }
    } else {
      if (this.classList.contains("fa-eye")) {
        confirmPasswordField.type = "text";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
      } else {
        confirmPasswordField.type = "password";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
      }
    }
  });
});

// close
document.querySelectorAll('.display_message i').forEach(function(el) {
  el.addEventListener('click', function() {
    var parent = this.parentElement;
    parent.style.animation = 'fadeOut 0.5s ease forwards';
    setTimeout(function() {
      parent.remove();
    }, 500); 
  });
});