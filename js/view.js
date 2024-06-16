// DELETE BLOCK

$(document).ready(function(){
    $('.delete-link').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('.confirmation-modal').show();
        
        setTimeout(function(){
            $('.confirmation-modal-content').css('opacity', '1');
        }, 100);

        $('.confirm-yes').on('click', function() {
            window.location.href = url;
        });

        $('.confirm-no').on('click', function() {
            $('.confirmation-modal-content').css('animation', 'fadeOut 0.5s ease forwards');
            setTimeout(function(){
                $('.confirmation-modal').hide();
                $('.confirmation-modal-content').css('animation', ''); 
            }, 500);
        });
    });
});

// DELETE BLOCK

// DISPLAY BLOCK SUCCESS
    document.querySelectorAll('.display_message i').forEach(function(el) {
  el.addEventListener('click', function() {
    var parent = this.parentElement;
    parent.style.animation = 'fadeOut 0.5s ease forwards';
    setTimeout(function() {
      parent.remove();
    }, 500); 
  });
});
// DISPLAY BLOCK SUCCESS