<?php session_start();include './fun.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about us</title>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <style>
        *{
            box-sizing: border-box;
        }
        header{background-color:rgb(42, 13, 61);}
        .container {
            width: 100%;
            height: 100%;

            justify-content: center;
            align-items: center;
            margin-top: 5%;
            
        }

        .first_p .first {
            width: 40%;
            margin: auto;
            font-size: 1.75rem;
            color: rgb(98, 98, 98);

        }
        .section_wrapper{
           margin-top: 6%;
           height: 300px;
           width: 1100px;
       
        }
        .section_wrapper img{
            border-radius: 50%;
        }
        
        .varient1{
            margin-bottom: 50px;
        }
        .varient2{
            background-color: whitesmoke;
            height: 100%;
            width: 100%;
            display: flex;
            padding: 2% 10%;
            
        }
        .varient2 .content1{
            padding-left: 5%;
            /* width: 50%; */
        }
      .head{
        font-size: 2.5rem;
        color:rgb(98, 98, 98)
      }
      .head2{
        font-size: 1.5rem;
        color:rgb(98, 98, 98)
      }
      .head3{
        font-size: 1.15rem;
        color:rgb(98, 98, 98)
      }
      .under{
        margin: 0%;
        font-size: 1.15rem;
        color:rgb(98, 98, 98)
      }
      .content1 p{
        width: 80%;
      }
      .FAQ{
        width: 60%;
        margin-left: 15%;
      }
      .faqh{
        font-size: xx-large;
        color:rgb(98, 98, 98)
      }
      .question{
        font-size: x-large;
        color:rgb(98, 98, 98)
      }
      .ans{
        font-size: large;
        font-weight: 600;
        color:rgb(98, 98, 98)
      }

      @media screen and (max-width:425px) {
        .varient2{    flex-wrap: wrap;height: auto;}
        .first_p .first { width: 100%;}
      
        .content1 p {
    width: 100%;
}
      }
    </style>
</head>

<body>
<?php include './navbar.php' ?>
    <section  class="varient1">
    <div class="container">
        <div class="first_p" style="text-align: center;">

            <p class="first">Simply upload a file, share the link, and the file is entirely destroyed once it has been
                downloaded. Set an expiration on the file so that it is erased after a specified period of time even if
                it was never downloaded for enhanced protection. <br><br>On our servers, all files are encrypted before
                being saved.</p>
                </div>
        </div>
        </section>
        <section class="varient2">
            <div class="section_wrapper">
                <img src="<?= base_url() ?>assets/images/softwaredevistock-1098316816.webp" width="100%" height="100%">
            </div>
            <div class="content1">
                <h1 class="head" >Secure</h1>
                <h3 class="head2" >With us, your files are secure.</h3>
                <!-- <h3 class="head3" style="margin: 0;">You may send any kind of file to anyone, anywhere in the globe.</h3> -->
                <p class="under"> Every stage of the process involves encrypting your data. HTTPS/TLS encryption is used for all interactions with, to, and between our servers, including file uploads, downloads, and API requests. Additionally, your submitted file data is re-secured using SSL when it is stored on our servers.

                </p>
                <br><br>
        
                <p class="under"> <span style="font-size: 1.15rem; font-weight: 600;">Data security needs ongoing attention to detail.</span>We regularly evaluate our security architecture, and where necessary, we instantly implement fixes and improvements. To ensure that they comprehend and follow security rules and best practices, all staff members are obliged to participate in regular training. </p>
                <br><br>
        
                <p class="under">When compared to transferring your files over email, chat, or other cloud storage services, sharing them with file.io is also fundamentally more secure. There is no lost data lingering in the cloud since files are immediately erased whenever they are downloaded or reach their expiration date.<span style="font-size: 1.15rem; font-weight: 600;">The data that isn't even there is the most secure!</span></p>
            </div>
        </section>
        <section>
            <div class="FAQ">
                <h2 class="faqh">FAQ</h2>
                <h3 class="question">Are there any backups or log files for the deleted file?</h3>
                <p class="ans">No, it is anonymous, and we remove all information. No identifiable information may be found in our log files. All files are encrypted and there are no backups.</p>
                <h3 class="question">Is it cost-free?</h3>
                <p class="ans">Yes, we do provide both free and premium options.</p>
                <h3 class="question">Is there a size limit?</h3>
                <p class="ans">Yes, there is a 2 GB free restriction on file transfers.</p>
                <h3 class="question">how can I contact you?</h3>
                <p class="ans">We'd be thrilled to hear from you: support@sharerapidly.com<p>
            </div>
        </section>
        <?php include './footer.php' ?>

</body>

</html>