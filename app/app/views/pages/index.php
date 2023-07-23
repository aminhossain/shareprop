<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3">
            <strong><?php echo $data['title']; ?></strong>
        </h1>
        <p class="lead"><?php echo $data['description']; ?></p>
        <a href="<?php echo URLROOT; ?>/props/add" class="btn btn-lg btn-dark border-none"><i class="fas fa-plus"></i> Add Your Property</a>
    </div>
</div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>