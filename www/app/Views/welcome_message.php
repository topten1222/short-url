<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
    <section class="bg_main">
        <div class="container cutt_main_inp">
            <div class="row">
                <div class="col-12 mt-4 py-2 mb-2">
                    <div class="input-group">
                        <input id="link" class="cutt_url w-100 p-4 rounded-12" type="text"
                               placeholder="Paste long url and shorten it" name="url" value="" onkeyup="restoreBtn()">
                        <button class="btn_cutt rounded-6 shortenit_b" onclick="send()" role="button">Shorten</button>
                    </div>
                    <input type="hidden" id="tmp">
                </div>
            </div>
        </div>

        <div id="results">
            <div class="container">
                <div class="row py-4">
                    <div class="col-12 result">
                        <div class="url_options rounded-6" id="0"><p class="nazwa_link">Page not found | Chin Power</p>
                            <p class="data_link">2021-04-02</p>
                            <p class="url_link"><a href="http://chinpower.net/wp/" target="blank">http://chinpower.net/wp/</a>
                            </p>
                            <p id="link" class="link_element"><a href="https://cutt.ly/RcjXz1U" class="short_url_l"
                                                                 target="blank">https://cutt.ly/RcjXz1U</a></p>
                            <button class="btn-cutt i_s" onclick="copyToClipboard(this)" data-toggle="tooltip"
                                    data-html="true" data-placement="top" title="" data-original-title="Copy">
                                <svg class="i_svg" viewBox="0 0 24 24">
                                    <use xlink:href="#i_copy"></use>
                                </svg>
                            </button>
                            <a href="register" class="d-inline-block">register to use other features</a><a
                                    href="https://cutt.ly/RcjXz1U-stats" class="btn-cutt click_stats">
                                <svg class="i_svg" viewBox="0 0 24 24">
                                    <use xlink:href="#i_chart"></use>
                                </svg>
                                <span><b class="badge">0</b>clicks</span></a></div>
                        <div class="url_options rounded-6" id="1"><p class="nazwa_link">Google</p>
                            <p class="data_link">2021-04-02</p>
                            <p class="url_link"><a href="http://www.google.com" target="blank">http://www.google.com</a>
                            </p>
                            <p id="link" class="link_element"><a href="https://cutt.ly/vcjXjdr" class="short_url_l"
                                                                 target="blank">https://cutt.ly/vcjXjdr</a></p>
                            <button class="btn-cutt i_s" onclick="copyToClipboard(this)" data-toggle="tooltip"
                                    data-html="true" data-placement="top" title="" data-original-title="Copy">
                                <svg class="i_svg" viewBox="0 0 24 24">
                                    <use xlink:href="#i_copy"></use>
                                </svg>
                            </button>
                            <a href="register" class="d-inline-block">register to use other features</a><a
                                    href="https://cutt.ly/vcjXjdr-stats" class="btn-cutt click_stats">
                                <svg class="i_svg" viewBox="0 0 24 24">
                                    <use xlink:href="#i_chart"></use>
                                </svg>
                                <span><b class="badge">1</b>clicks</span></a></div>
                    </div>
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