<?php
ob_start();
?>
<!-- <main class="container text-center mt-5">
    <h2 class="display-5 fw-bold">Welcome to Our Coffee Shop</h2>
    <p class="lead">Enjoy your coffee and rate our drinks!</p>
</main> -->

<main class="container text-center mt-5 py-5" style="background: url('uploads/Americano.png'); background-size: 'cover'; min-height: 100vh;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; ">
    <h2 class="display-5 fw-bold">Welcome to Our Coffee Shop</h2>
    <p class="lead">Enjoy your coffee and rate our drinks!</p>
</main>
<?php
$content = ob_get_clean();
include 'layout.php'; ?>