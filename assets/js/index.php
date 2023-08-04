<script>

var fileLink = document.getElementById('fileLink');
var fileInput = document.getElementById('upload1');
var fileLink2 = document.getElementById('uploadfile');
var fileInput2 = document.getElementById('upload');
const progressBar = document.getElementById('progress');

// Getting unique id(Ip) for Client
var ip
fetch('https://api.ipify.org?format=json')
  .then(response => response.json())
  .then(data => {
    ip = data.ip;
  })
  .catch(error => {
    console.log(error);
  });


// Cookie Generator
function createCookie(name, value, minutes) {
  var date = new Date();
  date.setTime(date.getTime() + (minutes * 60 * 1000));
  var expires = "expires=" + date.toUTCString();
  document.cookie = name + "=" + value + "; " + expires + "; path=/";
}

function getCookie(name) {
  var cookieName = name + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var cookieArray = decodedCookie.split(';');

  for (var i = 0; i < cookieArray.length; i++) {
    var cookie = cookieArray[i].trim();
    if (cookie.indexOf(cookieName) === 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }
  return "";
}

const formData = new FormData();
unique = '';
// Form One 
fileLink2.addEventListener('click', function (event) {
  event.preventDefault();
  let randomnum = Math.floor(Math.random() * 1000)
  unique = randomnum + ip;
  if(unique.length == 0){
    alert('Please Try After Sometime Or Refresh the page ')
  }else{
    fileInput2.click();
  }
  createCookie("id", unique, 60)
  // var selectedFiles = fileInput2.files;
  
});


async function executeLoop(x) {
  try {
    for (var i = 0; i < x.length; i++) {
      formData.append('images', x[i]);

      // await UploadFile(x[i])
      // if (i == (x.length - 1)) {
      //   document.getElementById('from-container').style.display = 'none';
      //   document.getElementById('copyslug').style.display = 'grid';
      //   const response = await DownloadLink();
      // }
    }

  } catch (error) {
    console.error('Upload error:', error);
  }
}
// QRCODE

// COPY TEXT URL
j = 0
  var uploader = new plupload.Uploader({
  runtimes: 'html5,flash,silverlight,html4',
  browse_button: 'upload', // you can pass an id...
  url: 'upload.php',
  flash_swf_url: 'plupload/js/Moxie.swf',
  silverlight_xap_url: 'plupload/js/Moxie.xap',
  multi_selection: false,
  chunk_size: "10mb",
  filters: {
    max_file_size: '<?php if(isset($row['upload_size'])){echo $row['upload_size'];}else{echo '2GB';}?>',
    mime_types: [
      { title: "Image files", extensions: "jpg,jpeg,gif,png,webp" },
      { title: "Video files", extensions: "mp4,avi,mpeg,mpg,mov,wmv" },
      { title: "Zip files", extensions: "zip" },
      { title: "Document files", extensions: "pdf,docx,xlsx,txt,exe" }
    ]
  },

  init: {
    PostInit: function () {
      document.getElementById('fileList').innerHTML = '';
    },

    FilesAdded: function (up, files) {
      var loaded = document.getElementById('loadingProcess')
      loaded.innerHTML = '';
      loaded.innerHTML += '<div> <div id="fileList" class="fileList"> <div class="progress-bar-container" id="progress-bar-container"><div class="progress" id="progress-bar"></div></div></div><br><div id="timeing"></div> <div id="statusResponse"></div></div>';

      plupload.each(files, function (file) {
        document.getElementById('fileList').innerHTML += '<div id="' + file.id + '" style="display: flex;justify-content: space-between;">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
      });
      file_count = files.length
      uploader.start();
    },

    UploadProgress: function (up, file) {
      // console.log(file._options.max_slots )// 

      document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
      document.querySelector(".progress").innerHTML = '<div class="progress-bar" style="width: ' + file.percent + '%;"></div>';

      // time take to upload
      var totalBytes = file.size;
      var uploadedBytes = file.loaded;
      var percentUploaded = (uploadedBytes / totalBytes) * 100; 

      // Calculate the estimated time remaining based on average upload speed
      var currentTime = new Date().getTime() / 1000; // Convert to seconds
      var timeElapsed = currentTime - up.settings.upload_start_time; // Time elapsed since upload start in seconds
      var averageSpeed = uploadedBytes / timeElapsed; // average upload speed in bytes per second
      var remainingBytes = totalBytes - uploadedBytes;
      var remainingTimeInSeconds = remainingBytes / averageSpeed;
      var remainingTimeInMinutes = Math.floor(remainingTimeInSeconds / 60);
      var remainingSeconds = Math.ceil(remainingTimeInSeconds % 60);

      var estimatedTime = remainingTimeInMinutes + " min " + remainingSeconds + " sec";
      document.getElementById('timeing').innerText = "Estimated time remaining for this file : " + estimatedTime



    },
    BeforeUpload: function (up, file) {


      up.settings.upload_start_time = new Date().getTime() / 1000;



      up.settings.multipart_params = up.settings.multipart_params || {};

      // Merge additional data with the existing multipart_params

      formData.append('identification', unique);
      formData.append('file_size_ha', file.size)
      var keysIterator = formData.keys();

      // Convert the iterator to an array of keys
      var keysArray = Array.from(keysIterator);

      for (let i = 0; i < keysArray.length; i++) {
        up.settings.multipart_params[[keysArray[i]]] = formData.get([keysArray[i]]);
      }
    },

    FileUploaded: function (up, file, result) {
      // console.log(result)
      // console.log(result.response)
      // var responseData = result.response.replace('"{', '{').replace('}"', '}');
      // var objResponse = JSON.parse(result.response);
      // document.getElementById('statusResponse').innerHTML = '<p style="color:#198754;">' + objResponse.result.message + '</p>';
      if (j == (parseInt(file_count) - 1)) {
        // document.getElementById('statusResponse').innerHTML = '<p style="color:#198754;">' + objResponse.success + '</p>';
        document.getElementById('from-container').style.display = 'none';
        document.getElementById('copyslug').style.display = 'grid';
        DownloadLink()
      }
      j++
    },

    Error: function (up, err) {
      // document.getElementById('statusResponse').innerHTML = '<p style="color:#EA4335;">Error #' + err.code + ': ' + err.message + '</p>';
      document.getElementById('statusResponse').innerHTML = '<p style="color:#EA4335;">Error #File Size Is Too Big Or file not supported</p>';
    }
  }
});

uploader.init();


function copyText() {
  textToCopy.select();
  textToCopy.setSelectionRange(0, 99999); // For mobile devices

  document.execCommand("copy");
}





</script>