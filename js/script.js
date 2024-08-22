// // Get the element you want to make fullscreen
// var element = document.documentElement;

// // Check if fullscreen mode is supported
// if (element.requestFullscreen) {
//   // Request fullscreen mode
//   element.requestFullscreen();
// } else {
//   // Fullscreen mode is not supported
//   console.log("Fullscreen mode is not supported.");
// }


// function changeImage(imgNum) {
//     // Get the target image element
//     var targetImg = document.getElementById("target-img");

//     // Set the source of the target image based on the image number
//   if (imgNum === 1) {
//       targetImg.src = "https://via.placeholder.com/400x400?text=1";
//     } else if (imgNum === 2) {
//       targetImg.src = "https://via.placeholder.com/400x400?text=2";
//     }
//   }
  
  window.addEventListener("load", function() {
    // Get the target image
    var targetImg = document.getElementById("target-img");
  
    // Get the URL of the current page
    var url = new URL(window.location.href);
  
    // Get the value of the "text" query parameter
    var text = url.searchParams.get("text");
  
    // Update the target image's source based on the "text" value
    targetImg.src = "https://via.placeholder.com/400x400?text=" + text;
  });




