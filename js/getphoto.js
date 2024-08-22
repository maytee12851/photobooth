document.addEventListener('DOMContentLoaded', function () {
    const myurl = window.location.search;
    const params = new URLSearchParams(myurl);
    getimg = params.get('img');

    $.ajax({
        type: "POST",
        url: "./php/searchimg.php",
        data: { img: getimg },
        success: function (data) {
            if (data.includes('png')) {
                preview.src = "./img/" + data;
                QR.src = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=https://photobooth.versemedia.io/img.html?img=' + getimg;
                var timeLeft = 90;
                var elem = document.getElementById('some_div');

                var timerId = setInterval(countdown, 1000);

                function countdown() {
                    if (timeLeft == 0) {
                        location.replace("./index.html");
                    } if (timeLeft < 10 & timeLeft >= 0) {
                        elem.innerHTML = '&nbsp;' + timeLeft;
                        elem.style.marginLeft = '2.5px';
                        timeLeft--;
                    }
                    else {
                        elem.innerHTML = timeLeft;
                        timeLeft--;
                    }
                }
            } else if (data == "Not found Image") {
                Swal.fire({
                    icon: 'error',
                    title: "<b>URL Error</b>",
                    text: 'Please contact administrator',
                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                    showConfirmButton: false,
                    timer: 5000
                })
                setTimeout(function () {
                    location.replace("./index.html");
                }, 5000);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: "<b>SQL Error</b>",
                    text: 'Please contact administrator',
                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                    showConfirmButton: false,
                    timer: 5000
                });
                setTimeout(function () {
                    location.replace("./index.html");
                }, 5000);
            }
        }
    })

}, false);