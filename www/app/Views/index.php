<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
    <section class="bg_main">
        <div class="container cutt_main_inp">
            <div class="row">
                <div class="col-12 mt-4 py-2 mb-2">
                    <div class="input-group">
                        <input id="link" class="cutt_url w-100 p-4 rounded-12" type="text"
                               placeholder="Paste long url and shorten it" name="url" value="">
                        <button class="btn_cutt rounded-6 shortenit_b" onclick="send()" role="button">Shorten</button>
                    </div>
                    <input type="hidden" id="tmp">
                </div>
            </div>
        </div>

        <div id="results">
            <div class="container">
                <div class="row py-4">
                    <?php foreach ($shortUrls as $shortUrl) {
                        /* @var $shortUrl \App\Models\ShortUrlModel */
                        $qrCode = "https://chart.googleapis.com/chart?cht=qr&chl=" . base_url($shortUrl['alias']);
                        ?>
                        <div class="col-8">
                            <div class="url_options rounded-6">
                                <p class="nazwa_link">Expired Date: <?= $shortUrl['expire_date'] ?></p>
                                <p class="data_link">
                                    <?= date('Y-m-d', strtotime($shortUrl['created_date'])) ?>
                                </p>
                                <p class="url_link">
                                    <a href="<?= $shortUrl['url'] ?>" target="blank">
                                        <?= $shortUrl['url'] ?>
                                    </a>
                                </p>
                                <p id="link" class="link_element">
                                    <a href="<?= base_url($shortUrl['alias']) ?>" class="short_url_l"
                                       target="blank">
                                        <?= base_url($shortUrl['alias']) ?>
                                    </a>
                                </p>
                                <button class="btn-cutt i_s" onclick="copyToClipboard(this)" data-toggle="tooltip"
                                        data-html="true" data-placement="top" title="" data-original-title="Copy">
                                    <svg class="i_svg" viewBox="0 0 24 24">
                                        <use xlink:href="#i_copy"></use>
                                    </svg>
                                </button>
                                <div class="btn-cutt click_stats">
                                    <svg class="i_svg" viewBox="0 0 24 24">
                                        <use xlink:href="#i_chart"></use>
                                    </svg>
                                    <span><b class="badge"><?= $shortUrl['hits'] ?></b>clicks</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="url_options rounded-6" style="text-align: center">
                                <a href="<?= $qrCode ?>&chs=200x200&choe=UTF-8" target="_blank">
                                    <img src="<?= $qrCode ?>&chs=150x150&choe=UTF-8">
                                </a>
                                <hr>
                                <a href="<?= base_url('download/' . $shortUrl['alias']) ?>">
                                    <button type="button" class="btn btn-primary">Download</button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <g class="parallax">
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(255,255,255,0.7"></use>
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(255,255,255,0.5)"></use>
                    <use xlink:href="#wave" x="48" y="5" fill="rgba(255,255,255,0.3)"></use>
                    <use xlink:href="#wave" x="48" y="7" fill="#fff"></use>
                </g>
            </svg>
        </div>
    </section>
<?php $this->endSection(); ?>