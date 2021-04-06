function send() {
    var url = $('input[name=url]').val();
    var expire_date = $('input[name=expire_date]').val();
    var cookieValue = [];
    if (is_valid_url(url) && expire_date != '') {
        $.ajax({
            url: `${base_url}/short-url`,
            method: 'post',
            data: {
                url: url,
                expire_date: expire_date
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
                    var html = `<div class="col-8"><div class="url_options rounded-6"><p class="nazwa_link">Expired Date: ${data.expired_date}</p>`+
                        `<p class="data_link">${data.date}</p><p class="url_link"><a href="${data.url}" target="blank">${data.url}</a>`+
                        `</p><p id="link" class="link_element"><a href="${base_url+'/'+data.alias}" class="short_url_l" target="blank">${base_url+'/'+data.alias}</a></p>`+
                        `<button class="btn-cutt i_s" onclick="copyToClipboard(this)" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Copy"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 6v16h-16v-16h16zm2-2h-20v20h20v-20zm-24 17v-21h21v2h-19v19h-2z"/></svg></button>` +
                            `<div class="btn-cutt click_stats"><svg class="i_svg" viewBox="0 0 24 24"><use xlink:href="#i_chart"></use></svg><span><b class="badge">0</b>clicks</span></div></div></div>`+
                        `<div class="col-4"><div class="url_options rounded-6" style="text-align: center"><a href="https://chart.googleapis.com/chart?cht=qr&chl=${base_url+data.alias}&chs=200x200&choe=UTF-8" target="_blank">`+
                        `<img src="https://chart.googleapis.com/chart?cht=qr&chl=${base_url+data.alias}&chs=150x150&choe=UTF-8"></a><hr><a href="${base_url+'download/'+data.alias}"><button type="button" class="btn btn-primary">Download</button></a></div></div>`;
                    $('#results .row').append(html);
                } else {
                    alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
                }
                $('input[name=url]').val('');
                $('input[name=expire_date]').val('');
            }
        });
    } else {
        alert('กรุณากรอกข้อมูลให้ถูกต้อง');
    }
}

function is_valid_url(url) {
    return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
}

function copyToClipboard(elem) {
    var url = $(elem).parent().find("#link").val();
    if (url === "") url = $(elem).parent().find("#link").text();
    var $temp = $("<input style='position: absolute; top: -1000px; left: -1000px;'>");
    $("body").append($temp);
    $temp.val(url).select();
    document.execCommand("copy");
    $temp.remove();
    alert("URL has been copied");
}