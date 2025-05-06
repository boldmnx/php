<?php

ob_start() ;


?>
<main class="container text-center mt-5">
    <h2 class="display-5 fw-bold">Welcome to Our Coffee Shop</h2>
    <p class="lead">Enjoy your coffee and rate our drinks!</p>
    <!-- <img src="coffee.jpg" alt="Coffee" class="img-fluid rounded shadow mt-3" style="max-height: 300px;"> -->
</main>
<?php
$content = ob_get_clean();
include 'layout.php'; ?>

