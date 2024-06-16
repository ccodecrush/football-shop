document.querySelectorAll('.display_message i').forEach(function(el) {
  el.addEventListener('click', function() {
    var parent = this.parentElement;
    parent.style.animation = 'fadeOut 0.5s ease forwards';
    setTimeout(function() {
      parent.remove();
    }, 500); 
  });
});