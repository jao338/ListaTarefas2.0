<?php 

session_start();

?>

<div class="card-message border">
    <div class="card-header-message d-flex justify-content-between align-item-center border">
        <div class="d-flex align-items-center paddingL-16">
            <?php echo $_SESSION['titulo']; ?>
        </div>
        <div class="d-flex align-items-center paddingR-8" style="cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
            </svg>
        </div>
    </div>

    <div class="card-body-message d-flex justify-content-center align-item-center text-center padding-16">
        <?php echo $_SESSION['mensagem']; ?>
    </div>
</div>