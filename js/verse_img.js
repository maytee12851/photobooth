let downloadCount = 1;

window.onload = function(){  
    const myurl = window.location.search;

    const params = new URLSearchParams(myurl);

    img = params.get('img');

    $.ajax({
        type: "POST",
        url: "./php/searchimg.php",
        data: { img: img },
        success: function(data){
            if(data.includes('png')){
                showimg.src = "./img/"+data;
            }else if(data == "Not found Image"){
                Swal.fire({
                    icon: 'error',
                    title: "<b>Worng URL</b>",
                    text:'Please check QR Code and try again later',
                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                    showConfirmButton: false,
                    timer: 5000
                })
                setTimeout(function() {
                    location.replace("https://www.facebook.com/Verse.X.Bangkok");
                }, 5000);

            }else{
                Swal.fire({
                    icon: 'error',
                    title: "<b>SQL Error</b>",
                    text:'Please contact administrator',
                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                    showConfirmButton: false,
                    timer: 5000
                });
               setTimeout(function() {
                    location.replace("https://www.facebook.com/Verse.X.Bangkok");
                }, 5000);
            } 
        }
      })

      var replace = document.getElementById('replaceme').getAttribute('data-href');
      console.log(replace);
      //var new = replace.replace('REPLACEME',img)
      document.getElementById('replaceme').setAttribute('data-href',replace.replace('REPLACEME',img));
      console.log(document.getElementById('replaceme').getAttribute('data-href'));
}

$('#downloadimg').on('click', function(){  
    // get the image URL
    var imageUrl = document.getElementById('showimg').src;

    var a = document.createElement('a');
    a.href = imageUrl;
  
    // set the download attribute and filename
    a.download = 'VersePhotobooth_' + downloadCount + '.png';
  
    // trigger the download by programmatically clicking the anchor element
    a.click();

    downloadCount++;
});
