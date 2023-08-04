<?php session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './fun.php' ?>

<?php
include './connection.php';

if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM `user_share` WHERE identification = '" . base64_decode($_GET['slug']) . "'";
} else {
    $sql = "SELECT * FROM `sharething` WHERE identification = '" . base64_decode($_GET['slug']) . "'";
}
$result = mysqli_query($conn, $sql);
$coun = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/function.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Download File | Share any thing</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body,
        html {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <div style="width: 100%;height: 100%; overflow:hidden;"><!-- place this div in RDP -->
        <div style="position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;overflow:hidden;"><img src="<?= base_url() ?>assets/images/a.webp" id="desk_image" width="100%" height="100%" alt="No Image"></div>
        <?php include './navbar.php' ?>
        <div class="container" id="container" style="position:relative;">

            <?php if (mysqli_num_rows($result) > 0) {
                $rowsss = $coun->fetch_assoc()
            ?>
                <div class="box">
                    <h1 style="margin: 0;padding:0;">Download your file</h1>
                    <h3 style="margin: 0 0 20px 0;padding:0;">Download Remaining :<?= $rowsss['download_count'] ?> </h3>
                    <div class="box2">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="file">
                        <input type="text" value="' . $row["image"] . '" readonly><button onclick="Download(\'' . $row['image_path'] . '\',' . $row["id"] . ',\'' . base64_decode($_GET['slug']) . '\')" class="Btn">
                            <svg class="svgIcon" viewBox="0 0 384 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"></path>
                            </svg>
                            <span class="tooltip">Download</span>
                        </button>
                        </div>';
                        }
                    } else {
                        ?>

                        <div class="container" style="display: grid;align-items:center;justify-content:center;width:100%;height:100%;">
                            <div class="box" style="text-align: center;background-color:transparent;box-shadow:5px 5px 25px 5px white;">
                                <h1 style="text-align: center;width:80%;margin:auto;user-select:none;">The File Your Are Trying To Download is Already beeing Downloaded or Link has Been Expired</h1>
                                <a href="<?= base_url() ?>" style="font-size: 2rem;color:black;">Back To Home</a>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                    </div>
                </div>
        </div>
    </div>
    <?php include './footer.php' ?>
    <script>
        function Download(path, id, slug) {
            fetch('<?= base_url() ?>redirect', {
                method: 'POST',
                body: JSON.stringify({
                    'id': id,
                    'slug': slug,
                }),
            }).then((response) => {
                if (response.ok) {
                    const downloadLink = document.createElement('a');
                    downloadLink.href = '<?= base_url() ?>ab.php?path=' + path + '';
                    downloadLink.setAttribute('download', '<?= $rowsss['image'] ?>');
                    downloadLink.click();
                    downloadLink.remove();
                    RemoveFromList(id, slug);
                    location.reload();
                } else {
                    console.error('Error:', response);
                }
            })
        }

        function RemoveFromList(id, slug) {
            fetch('<?= base_url() ?>delete', {
                    method: 'POST',
                    body: JSON.stringify({
                        'id': id,
                        'slug': slug,
                    })
                }).then((d) => d.text())
                .then((d) => console.log(d))
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
    </script>
</body>

</html>
<!-- 

.container{height:auto;}
.container2{height:auto;}

 -->