function send() {
    var url = $('input[name=url]').val();
    var cookieValue = [];
    if (url) {
        console.log(`${base_url}/short-url`);
        $.ajax({
            url: `${base_url}/short-url`,
            method: 'post',
            data: {
                url: url
            },
            dataType: "json",
            success: function(res) {
                if (res.message === 'success') {
                    var data = res.data;
                    if ($.cookie('shortUrls')) {
                        var updateCookie = $.cookie('shortUrls')+','+data.alias;
                        $.cookie('shortUrls', updateCookie, {expires: 7});
                    } else {
                        $.cookie('shortUrls', data.alias, {expires: 7});
                    }
                    var html = `<div class="col-8""><p class="nazwa_link">Expired Date: ${data.expired_date}</p>`+
                        `<p class="data_link">${data.date}</p><p class="url_link"><a href="${data.url}" target="blank">${data.url}</a>`+
                        `</p><p id="link" class="link_element"><a href="${base_url+data.alias}" class="short_url_l" target="blank">${base_url+data.alias}</a></p>`+
                        `<button class="btn-cutt i_s" onclick="copyToClipboard(this)" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Copy"><svg class="i_svg" viewBox="0 0 24 24"><use xlink:href="#i_copy"></use></svg></button>` +
                        `<div class="btn-cutt click_stats"><svg class="i_svg" viewBox="0 0 24 24"><use xlink:href="#i_chart"></use></svg><span><b class="badge">0</b>clicks</span></div></div>`+
                        ` <div class="col-4"><div class="url_options rounded-6" style="text-align: center"><a href="https://chart.googleapis.com/chart?cht=qr&chl=${base_url+data.alias}&chs=200x200&choe=UTF-8" target="_blank">`+
                        `<img src="https://chart.googleapis.com/chart?cht=qr&chl=${base_url+data.alias}&chs=150x150&choe=UTF-8"></a><hr><a href="${base_url+'download/'+data.alias}"><button type="button" class="btn btn-primary">Download</button></a></div></div>`;
                    $('#container .row').append(html);
                } else {
                    console.log(res.message);
                }
                $('input[name=url]').val('');
            }
        });
    } else {
        alert('Invalid input url patten');
    }
}

function is_valid_url(url) {
    return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
}