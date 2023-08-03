<?php

 session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './connection.php';
include './fun.php' ?>
<?php
$sql = "SELECT * FROM userdata AS t1 INNER JOIN priceing AS t2 ON t1.plan = t2.plan_id WHERE t1.email ='{$_SESSION['user_email']}' && t1.id = {$_SESSION['user_id']}  ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
  $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" async></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.5/plupload.full.min.js" integrity="sha512-yLlgKhLJjLhTYMuClLJ8GGEzwSCn/uwigfXug5Wf2uU5UdOtA8WRSMJHJcZ+mHgHmNY+lDc/Sfp86IT9hve0Rg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

    </style>
    <title>Share Any Things || Share File</title>
</head>

<body>

    <div class="container2">
        <?php include './navbar.php' ?>
        <div style="position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;overflow:hidden;"><img src="<?= base_url() ?>assets/images/a.webp" id="desk_image" width="100%" height="100%" alt="No Image"></div>
        <div class="container" id="container" style="position:relative;">


            <div class="from-container" id="from-container">
                <span id="loadingProcess">
                    <h2>Share any File any where </h2>
                    <p>Upload as many files as you like up to 1 GB and get a link to share.</p>

                    <form id="form" method="post" enctype="multipart/form-data">
                        <input type="file" name="upload" id="upload" multiple><br>
                        <!-- or <a id="fileLink">Upload a Folder</a> -->
                        <input type="file" name="upload1" id="upload1" webkitdirectory mozdirectory multiple>
                        <button id="uploadfile" style="display: flex;align-items:center;justify-content:center;margin:auto;flex-direction: column;"><i class="ri-upload-fill" style="font-size: x-large;margin-right:5px"></i>Upload Files</button>
                        
                        <!-- List the selected files -->
                        <div id="statusResponse"></div>
                        <div id="fileList"></div>
                    </form>
                </span>
            </div>


            <div class="copyslug" id="copyslug">
                <div id="banter-loader">
                    <div class="banter-loader">
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                        <div class="banter-loader__box"></div>
                    </div>
                </div>
                <div class="copys" id="copys">
                    <span>
                        <h1>Your file is ready to share!</h1>
                        <p>Copy the download link below or scan the QR code.</p>
                    </span>
                    <div class="urlbox">
                        <input type="text" id="textToCopy" value="" readonly><button id="copyButton" onclick="copyText()">Copy</button>
                    </div>
                    <div class="qr">
                        <div id="qrcode"></div>
                        <div class="edit_list">
                            <div class="form-group">
                                <label for="">Number Of Downloads</label><br>
                                <select name="download_count" id="download_count">
                                    <option value="1">1 Download </option>
                                    <option value="2">2 Downloads </option>
                                    <?php if($row['plan'] == 2 || $row['plan'] == 3 ){ ?>
                                    <option value="3" >3 Downloads </option>
                                    <option value="4" >4 Downloads </option>
                                    <option value="5" selected>5 Downloads </option>
                                    <?php }else{
                                        ?>
                                        <option value="3" disabled>3 Downloads <span id="pre">(Premium)</span></option>
                                    <option value="4" disabled>4 Downloads <span id="pre">(Premium)</span></option>
                                    <option value="5" disabled>5 Downloads <span id="pre">(Premium)</span></option>
                                        <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Days of Expiry</label><br>
                                <select name="expiry_days" id="expiry_days">
                                    <option value="1">1 Day</option>
                                    <option value="2">2 Days</option>
                                    <?php if($row['plan'] == 2 || $row['plan'] == 3 ){ ?>
                                    <option value="5" selected>5 Days </option>
                                    <option value="7" >7 Days </option>
                                    <option value="30" >30 Days </option>
                                    <option value="365" >365 Days </option>
                                    <?php }else{
                                        ?> 
                                        <option value="5" disabled>5 Days <span id="pre">(Premium)</span></option>
                                    <option value="7" disabled>7 Days <span id="pre">(Premium)</span></option>
                                    <option value="30" disabled>30 Days <span id="pre">(Premium)</span></option>
                                    <option value="365" disabled>365 Days <span id="pre">(Premium)</span></option>
                                        <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="backtopage">
                        <p style="color: dodgerblue;">You Data will be Deleted automatically after downloading or after 24 Hrs</p>
                        <!-- <p>You Data will be Deleted automatically after 1 days</p> -->
                        <a href="<?= base_url() ?>">Share More Files</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once './footer.php' ?>
    <script>
        // $(document).ready(function(){
        //     console.log('Share any File any where')
        // })
        function DownloadLink() {
            var textToCopy = document.getElementById("textToCopy");
            fetch('<?= base_url() ?>generatelink', {
                method: 'POST',
                body: JSON.stringify({
                    'id': unique
                })
            }).then(function(response) { 
                return response.json();
            }).then(function(data) {
                document.getElementById('banter-loader').style.display = 'none';
                document.getElementById('copys').style.display = 'grid';
                document.getElementById('container').style.alignItems = 'start';
                textToCopy.value = data['url'];
                var qrCodeDiv = document.getElementById("qrcode");
                // console.log(getCookie('id'));
                // console.log(data);
                // console.log(unique);
                var qrCode = new QRCode(qrCodeDiv, {
                    text: document.getElementById('textToCopy').value, // The content you want to encode
                    width: 200, // Width of the QR code in pixels
                    height: 200, // Height of the QR code in pixels
                });
                qrCodeDiv.getElementsByTagName("img")[0].alt = "QR Code";
            })

        }
        var qrCodeDiv = document.getElementById("qrcode");
    </script>

<!-- ADDING Extra JavaScript File In PHP Extention -->
<?php include './assets/js/index.php' ?>
<!-- ADDING Extra JavaScript File In PHP Extention -->

    <script>
        document.getElementById('download_count').addEventListener('change', function() {
            let downloadCount = this.value;
            let column = 'download_count';
            let url = document.getElementById("textToCopy").value;
            UpdateChange(downloadCount, url, column)
        })
        document.getElementById('expiry_days').addEventListener('change', function() {
            let downloadCount = this.value;
            let column = 'expiry';
            let url = document.getElementById("textToCopy").value;
            UpdateChange(downloadCount, url, column)
        })

        function UpdateChange(downloadCount, url, column) {
            fetch('<?= base_url() ?>update', {
                    method: 'POST',
                    body: JSON.stringify({
                        'count': downloadCount,
                        'url': url,
                        'columnName': column
                    })
                }).then(res => res.text())
                .then((data) => {
                    // data = JSON.parse(y)
                    // console.log(y)
                    // if (data['spec'] == 'download_count') {
                    //     document.getElementById('download_count').value = data['id']
                    // } else if (data['spec'] == 'expiry') {
                    //     document.getElementById('expiry_days').value = data['id']
                    // }
                })
        }

        document.getElementById('menu_').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'grid';
        })
        document.getElementById('close').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'none';
        })
        var image = document.getElementById('desk_image');
        var originalSrc = '<?= base_url() ?>assets/images/a.webp';
        var alternateSrc = '<?= base_url() ?>mobie_share.webp';

        function handleResize() {
            var windowWidth = window.innerWidth || document.documentElement.clientWidth;
            if (windowWidth >= 500) {
                image.src = originalSrc;
            } else {
                image.src = alternateSrc;
            }
        }
        window.addEventListener('resize', handleResize);
        handleResize();


        // window.addEventListener('beforeunload', function(e) {
        //     e.preventDefault();
        //     e.returnValue = '';
        // })
        // localStorage.clear();
    </script>



</body>

</html>