<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
    <section class="page_cuttly">
        <div class="container">
            <div class="row">
                <div class="col-12 max800">
                    <h2 class="h1_of">Ooops... 404</h2>
                    <h3 class="h1_of">That URL doesn't exists.</h3>
                    <img src="<?= base_url('assets/images/404.svg') ?>" alt="404">
                </div>
            </div>
        </div>
    </section>
<?php $this->endSection(); ?>