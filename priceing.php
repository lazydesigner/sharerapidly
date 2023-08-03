<?php include './fun.php'; session_start() ?>
<?php require_once 'config.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <title>Price || Sharerapidly File Share </title>
    <style>
        header {
            background-color: rgb(42, 13, 61);
        }

        .price-container {
            padding: 5%;
        }

        .row {
            width: 80%;
            margin: auto;
            display: flex;
            align-items: start;
            justify-content: space-between;


        }

        .row .col-1 {
            width: 300px;
            height: auto;
            border: 1px solid lightblue;
            border-radius: 5px;
            padding: 2% 1%;
            background-color: whitesmoke;
        }

        .row .col-1 h2 {
            font-size: 2rem;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .row .col-1 p {
            line-height: 1.7em;
            font-weight: 600;
            color: darkgray;
        }

        .row .col-1 ul {
            list-style: none;
            font-weight: 500;
            color: darkgray;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .price-tag-head {
            padding: 1% 5%;
            text-align: center;
        }

        .price-tag-body {
            padding: 1% 5%;
            text-align: justify;
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            justify-content: center;
            /* align-items: baseline; */
            gap: 2px;
            /* position: relative; */
        }

        .price-tag b {
            align-self: auto;
        }

        .price-tag span {
            font-size: 2.7rem;
        }
        .payment_btn{
            width: 100%;
            height: 50px;
            border-radius: 5px;
            font-weight: bold;
            color: white;
            background-color: indigo;
            margin-top:15px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include './navbar.php' ?>
    <div class="price-container">
        <h1 style="text-align: center;">Pricing Plan</h1><br />
        <div class="row">
            <div class="col-1">
                <div class="price-tag-head">
                    <span style="display:flex;align-items:center;justify-content:center;">
                        <h2>Free</h2>(Active)
                    </span>
                    <div class="price-tag">
                        <div style="position: relative;"><b>$</b><span>0</span></div>/mo
                    </div>
                    <hr />
                </div>
                <div class="price-tag-body">
                    <p>The sharerapidly.com online application lets you manage your files.</p>
                    <ul>
                        <li><i class="ri-play-mini-fill"></i>Share files up to 2gb</li>
                        <li><i class="ri-play-mini-fill"></i>Files Auto - Deleted After 1 Download</li>
                        <li><i class="ri-play-mini-fill"></i>Manage your files with ShareRapidly Securely</li>
                    </ul>
                </div>
                
            </div>
            <div class="col-1">
                <div class="price-tag-head">
                    <span style="display:flex;align-items:center;justify-content:center;">
                        <h2>Standard</h2>
                    </span>
                    <div class="price-tag">
                        <div style="position: relative;"><b>$</b><span>10</span></div>/mo
                    </div>
                    <hr />
                </div>
                <div class="price-tag-body">
                    <p>The sharerapidly.com online application lets you manage your files.</p>
                    <ul>
                        <li><i class="ri-play-mini-fill"></i>10gb Maximum Upload Size</li>
                        <li><i class="ri-play-mini-fill"></i>Maximum 200 GB space</li>
                        <li><i class="ri-play-mini-fill"></i>Files Availability 45 days</li>
                        <li><i class="ri-play-mini-fill"></i>Unlimited File Downloadd</li>
                        <li><i class="ri-play-mini-fill"></i>Manage your files with ShareRapidly Securely</li>
                    </ul>
                </div>
                <div>
                <form action="<?php echo PAYPAL_URL; ?>" method="POST">
    <!-- Identify your bussiness so that you can collect the payment -->
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

    <!-- Specify a buy now button -->
    <input type="hidden" name="cmd" value="_xclick">

    <!-- Specify details about the item that buyers will purchase -->
    <input type="hidden" name="item_name" value="Standart Plan">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="10">
    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>" >

    <!-- Specify URLs -->
    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>" >
    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>" >

    <!-- Display the payment button -->
    <?php
    if(isset($_SESSION['user'])){ ?>
        <input type="submit" name="submit" style="border:0;display:block;" class="payment_btn" value="Active Now" >
    <?php }else{?>
        <a href="<?= base_url() ?>priceing"><button>Active Now</button></a>
    <?php  } ?>
</form>
                </div>
            </div>
            
            <div class="col-1">
                <div class="price-tag-head">
                    <span style="display:flex;align-items:center;justify-content:center;">
                        <h2>Premium</h2>
                    </span>
                    <div class="price-tag">
                        <div style="position: relative;"><b>$</b><span>25</span></div>/mo
                    </div>
                    <hr />
                </div>
                <div class="price-tag-body">
                    <p>The sharerapidly.com online application lets you manage your files.</p>
                    <ul>
                        <li><i class="ri-play-mini-fill"></i> 30gb Maximum Upload Size</li>
                        <li><i class="ri-play-mini-fill"></i> Maximum 1TB space</li>
                        <li><i class="ri-play-mini-fill"></i> Files Availability 90 days</li>
                        <li><i class="ri-play-mini-fill"></i> Password Protection</li>
                        <li><i class="ri-play-mini-fill"></i>Unlimited File Download</li>
                        <li><i class="ri-play-mini-fill"></i>Antivirus Check</li>
                        <li><i class="ri-play-mini-fill"></i>Manage your files with ShareRapidly Securely</li>
                    </ul>
                </div>
                <div>
                <form action="<?php echo PAYPAL_URL; ?>" method="POST">
    <!-- Identify your bussiness so that you can collect the payment -->
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

    <!-- Specify a buy now button -->
    <input type="hidden" name="cmd" value="_xclick">

    <!-- Specify details about the item that buyers will purchase -->
    <input type="hidden" name="item_name" value="Premium Plan">
    <input type="hidden" name="item_number" value="2">
    <input type="hidden" name="amount" value="25">
    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>" >

    <!-- Specify URLs -->
    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>" >
    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>" >

    <!-- Display the payment button -->
    <?php
    if(isset($_SESSION['user'])){ ?>
        <input type="submit" name="submit" style="border:0;display:block;" class="payment_btn" value="Active Now" >
    <?php }else{?>
        <a href="<?= base_url() ?>priceing"><button>Active Now</button></a>
    <?php  } ?>
</form>
                </div>
            </div>

        </div>
    </div>
    <?php include './footer.php' ?>
</body>

</html>
<!-- SECREY KEY = sk_test_51NZ9a4SIGRfNc3rS5kkkmVXjsOd7fisIoyElSVNTqOF7bN87PP269uZIGv7iVqLoILlCxyH9p5rcaD4gya42SRCa000oYc6q4J -->
<!-- PUBLICCATION KEY = pk_test_51NZ9a4SIGRfNc3rSSCfWx5aHrmHvxNXDHsL9t7GKmKjdBLFcgU60HH4KZIPac7zgNT9l2FdfHnhmKYK5ehVQMSdS00LzL8oQ67  -->