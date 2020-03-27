<!-- <?php #PHP variables ?> -->
<?php require 'includes/controllers/controller-member-home.php'; ?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/persistent-navbar-member.php'; ?>

<!-- Header -->
<?php require 'includes/views/header-member-home.php'; ?>

<!-- Page Content -->
<?php require 'includes/views/content-member-home.php'; ?>

<script>
  'use strict';
  
  document.addEventListener('click', function(event) {
    if (event.target.closest('.ex')) {
      let ex = event.target.closest('.ex'),
          ex_showing = ex.parentElement.querySelectorAll('.w3-show'),
          ex_descr = ex.querySelector('.ex-descr');

      ex_descr.classList.toggle("w3-show");
      for (var i = 0; i < ex_showing.length; i++) {
        ex_showing[i].classList.remove('w3-show');
      }
    }
  });
</script>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>
