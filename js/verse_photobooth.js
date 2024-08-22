frame = "";
pic1 = "";
pic2 = "";
pic3 = "";
pic4 = "";
filepic1 = "";
filepic2 = "";
filepic3 = "";
filepic4 = "";
compurl = "";

//Open  
const video = document.getElementById('webcam');

navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(error => {
        console.error(error);
    });

function landing() {
    $.ajax({
        url: './php/check_sql.php',
        type: 'POST',
        success: function (data) {
            if (data != "successfully") {
                Swal.fire({
                    icon: 'error',
                    title: "<b>SQL Error</b>",
                    text: 'Please contact administrator',
                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                    showConfirmButton: false,
                    timer: 3000
                })
                //console.log('Verse: SQL Error')
                setTimeout(function () {
                    location.replace("index.html");
                }, 3000);

            }
        }
    })
};

$('#snap').on('click', function () {
    const myurl = window.location.search;

    const params = new URLSearchParams(myurl);

    frame = params.get('text');

    const shutterSound = new Audio('sound/Camera_Shutter_Sound_Effect.mp3');

    //countdown3sec();
    setTimeout(function() {
        shutterSound.play();
        pic4 = snap();
        setTimeout(() => {
            img4.src = pic4;
            img4.classList.add('animate__animated', 'animate__fadeInDown');
        }, 1000);
        
        setTimeout(function() {
            shutterSound.play();
            pic3 = snap();
            setTimeout(() => {
                img3.src = pic3;
                img3.classList.add('animate__animated', 'animate__fadeInDown');
                // img3.classList.add('shadowMyself')
            }, 1000);
            
            setTimeout(function() {
                shutterSound.play();
                pic2 = snap();
                setTimeout(() => {
                    img2.src = pic2;
                    img2.classList.add('animate__animated', 'animate__fadeInDown');
                }, 1000);
                
                setTimeout(function() {
                    shutterSound.play();
                    pic1 = snap();
                    setTimeout(() => {
                        img1.src = pic1;
                        img1.classList.add('animate__animated', 'animate__fadeInDown');
                    }, 1000);
                    
                    waitpopup();
                    
                    setTimeout(function() {
                        combind();
                        share();
                        setTimeout(function() {
                            download();
                        }, 1300);
                    }, 1700);
                }, 3800); //6000
            }, 4200); //6000
        }, 4200); //6000
    }, 6200); //6000
});

function waitpopup() {

    setTimeout(function () {
        Swal.fire({
            icon: 'success',
            title: 'Please wait a moment',
            text: 'The system is currently processing',
            timer: 10000,
            timerProgressBar: false,
            showConfirmButton: false
        });
    }, 1000);

}

function snap() {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    // กำหนดขนาด canvas ใหม่เพื่อรองรับการหมุน
    canvas.width = video.videoHeight;
    canvas.height = video.videoWidth;

    // ย้ายจุดศูนย์กลางของการหมุนไปที่กลาง canvas
    context.translate(canvas.width / 2, canvas.height / 2);

    // สะท้อนภาพในแนวนอน
    context.scale(-1, 1);

    // หมุน context 90 องศา
    context.rotate(Math.PI / 2);

    // วาดภาพที่ศูนย์กลางของ canvas หลังจากการหมุน
    context.drawImage(video, -video.videoWidth / 2, -video.videoHeight / 2);

    let imageDataUrl = canvas.toDataURL("image/png");

    return imageDataUrl;
}


function combind() {

    var canvas = document.getElementById("comp");
    var ctx = canvas.getContext("2d");

    var img1 = document.getElementById("img1");
    var img2 = document.getElementById("img2");
    var img3 = document.getElementById("img3");
    var img4 = document.getElementById("img4");
    const myurl = window.location.search;

    const params = new URLSearchParams(myurl);
    framecheck = params.get('text');
    if (framecheck == 1) {
        var frame = document.getElementById("frame1");
    }
    if (framecheck == 2) {
        var frame = document.getElementById("frame2");
    }
    if (framecheck == 3) {
        var frame = document.getElementById("frame3");
    }
    if (framecheck == 4) {
        var frame = document.getElementById("frame4");
    }
    if (framecheck == 5) {
        var frame = document.getElementById("frame5");
    }
    if (framecheck == 6) {
        var frame = document.getElementById("frame6");
    }
    if (framecheck == 7) {
        var frame = document.getElementById("frame7");
    }
    if (framecheck == 8) {
        var frame = document.getElementById("frame8");
    }

    try {
        ctx.drawImage(img4, 30, 29, 360, 460);
        ctx.drawImage(img3, 410, 29, 360, 460);
        ctx.drawImage(img2, 30, 503, 360, 460);
        ctx.drawImage(img1, 410, 503, 360, 460);
        ctx.drawImage(frame, 0, 0, canvas.width, canvas.height);
    }
    catch (err) {
        Swal.fire({
            icon: 'error',
            title: "<b>Camera Not Found</b>",
            text: 'Please connect camera',
            footer: '<p style="font-size:14px">Verse Media Techonology</p>',
            showConfirmButton: false
        });
        setTimeout(function () {
            location.replace("./index.html");
        }, 3000);
        //console.log(err.message);
        throw err;
    }
}

function share() {
    const canvas = document.getElementById("comp");

    let imageDataUrl = canvas.toDataURL("image/png");

    compurl = imageDataUrl;
    showcomp.src = imageDataUrl;

}

function download() {
    $.ajax({
        type: "POST",
        url: "./php/downloadimage.php",
        data: { picurl: compurl, frame: frame },
        success: function (data) {
            if (data.includes('png')) {
                const url = compurl;
                subtxt = data.substring(0, 5);
                window.location.href = "./getphoto.html?img=" + subtxt;
            }
        }
    })
}

function countdown() {
    document.getElementById("countdown-txt").innerHTML = "5";
    console.log("5")
    setTimeout(function () {
        document.getElementById("countdown-txt").innerHTML = "4";
        setTimeout(function () {
            document.getElementById("countdown-txt").innerHTML = "3";
            setTimeout(function () {
                document.getElementById("countdown-txt").innerHTML = "2";
                setTimeout(function () {
                    document.getElementById("countdown-txt").innerHTML = "1";
                    setTimeout(function () {
                        document.getElementById("countdown-txt").innerHTML = "";
                    }, 1000);
                }, 1000);
            }, 1000);
        }, 1000);
    }, 1000);
}

function countdown3sec() {
    document.getElementById("countdown-txt").innerHTML = "3";
    setTimeout(function () {
        document.getElementById("countdown-txt").innerHTML = "2";
        setTimeout(function () {
            document.getElementById("countdown-txt").innerHTML = "1";
            setTimeout(function () {
                document.getElementById("countdown-txt").innerHTML = "";
            }, 1000);
        }, 1000);
    }, 1000);
}