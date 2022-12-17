
<?php
require("partials/head.partial.php");
?>
    <style>
        .mapouter{
            position:relative;
            text-align:right;
            height:300px;
            max-width:600px;
            width:100%;
        }
        .gmap_canvas {
            overflow:hidden;
            background:none!important;
            height:300px;
            max-width:600px;
            width:100%;
        }
        iframe {
            height:300px;
            max-width:600px;
            width:100%;
        }
        #count_message {
            background-color: #6c757d;
            position: absolute;
            left: 2px;
            bottom: 2px;
        }
        .textarea {
            position: relative;
        }
        textarea {
            width: 100%;
            max-width: 500px;
        }
    </style>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card mb-3 changeaccount">
                <h2 class="card-title ms-1">Contact</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/contact")?>" method="POST">
                        <h5 class="card-title">Email:</h5>
                        <p class="card-text">
                            <input type="text" name="email" placeholder="email" value="<?=$email?>">
                        </p>
                        <h5 class="card-title">Bericht:</h5>
                        <p class="card-text textarea">
                            <textarea name="message" maxlength="256" rows="3" id="text" placeholder="bericht..." onkeyup="updateTextArea()"><?=$message?></textarea>
                            <span class="badge badge-primary" id="count_message">0 / 256</span>
                        </p>
                        <button type="submit" class="btn btn-danger">Versturen</button>
                    </form>
                </div>
                <?php
                if (!empty($error)) {
                    ?>
                    <div class="card-footer bg-danger">
                        <small class="text-white"><?=$error?></small>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="card">
                <h2 class="card-title ms-1">Adres</h2>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Prof.%20Zuurlaan%2022&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                        </div>
                        <p class="card-text">
                            Flevosap bv <br>
                            Prof. Zuurlaan 22 <br>
                            8256 PE Biddinghuizen, Nederland <br>
                            T: +31 (0)321 – 33 25 25 <br>
                            E: info@flevosap.nl <br>
                            <br>
                            KvK 58224483 <br>
                            BTW NL8529.322.73.B.01 <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

    <script>
        var text_max = 256;
        document.getElementById('count_message').innerHTML = '0 / ' + text_max;

        function updateTextArea() {
            var text_length = document.getElementById('text').value.length;
            document.getElementById('count_message').innerHTML = text_length + ' / ' + text_max;
        }

        updateTextArea();
    </script>

<?php
require("partials/foot.partial.php");
?>