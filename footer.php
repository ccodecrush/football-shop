<link rel="stylesheet" href="./css/footer.css">

<footer class="footer">
  <div class="footer__content">
    <div class="footer__accordion">
      <img src="./img/logotext.png" alt="Logo" > 
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, amet.</p>  <div class="footer__icons"> 
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
      </div>
    </div>
    <hr>
    <div class="footer__accordion">
      <h4>Company<i class="fas fa-chevron-down"></i></h4>
      <ul class="accordion"> 
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
      </ul>
    </div>
<hr>
    <div class="footer__accordion">
      <h4>Movement<i class="fas fa-chevron-down"></i></h4>
      <ul class="accordion"> 
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
      </ul>
    </div>
<hr>
    <div class="footer__accordion">
      <h4>Help<i class="fas fa-chevron-down"></i></h4>
      <ul class="accordion">
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
        <li><a href="#">Lorem</a></li>
      </ul>
    </div>
  </div>
</footer>

<script>
 $(document).ready(function() {
        $('.footer__accordion h4').click(function() {
          $(this).toggleClass('active');
          $(this).next('.accordion').toggleClass('active');
        });
      });
</script>
