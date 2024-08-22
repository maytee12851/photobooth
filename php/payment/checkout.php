<?php
session_start();
$public_key = 'pkey_test_5zzupkisj86akkqoe3v';
$secret_key = 'skey_test_5zzupkzi7u606lp5u7j';

if (!empty($_REQUEST['source'])) {
    $url = 'https://api.omise.co/charges';
    require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';
    define('OMISE_API_VERSION', '2019-05-29');
    define('OMISE_PUBLIC_KEY', $public_key);
    define('OMISE_SECRET_KEY', $secret_key);

    $event = OmiseCharge::retrieve($_SESSION['charge_id']);

    if ($event["source"]["charge_status"] == 'successful') {
        header("location: ../../selectframe.html?charge_id=" . $charge_id);
        exit(0);
    } else {
        $img_qr = $event['source']['scannable_code']["image"]["download_uri"];
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    text-align: center;
                    background-image: url('/image/UI/BG_All.png');
                }

                .container {
                    display: flex;
                    align-items: center;
                    margin-top: 20px;
                    margin-right: 360px;
                }

                .container a {
                    margin-right: 20px;
                    margin-top: 730px;
                }

                .qr {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 170px;
                }

                .phone {
                    position: absolute;
                    max-width: 520px;
                    height: auto;
                    margin-left: 445px;
                }         

                .move-count {
                    position: absolute;
                    top: 90%;
                    right: 3%;
                    transform: translate(-50%, -50%);
                }

                #some_div {
                    color: #a84d21;
                    font-size: 48px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 10;
                }

                .circle {
                    position: relative;
                    width: 80px;
                    height: 80px;
                    background-color: white;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
            <title>QR Code</title>
        </head>
        <body>
            <div class='move-count'>
                <div id='some_div'>

                </div>
                <div class='circle'></div>
            </div>

            <div class='container'>
                <a href='/index.html'><img src='/image/UI/2.payment/กลับสู่หน้าหลัก.png' alt='กลับหน้าหลัก' style='width:350px;'></a>
                <img src='/image/UI/2.payment/Phone.png' alt='Phone Image' class='phone'>
                <img src='" . $img_qr . "' alt='QR Code' style='width:670px;height:670px;' class='qr'>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                var timeLeft = 90;
                var elem = document.getElementById('some_div');

                var timerId = setInterval(countdown, 1000);

                function countdown() {
                    if (timeLeft <= 0) {
                        clearInterval(timerId);
                        location.replace('/index.html');
                    } else {
                        if (timeLeft < 10) {
                            elem.innerHTML = '&nbsp;' + timeLeft;
                            elem.style.marginLeft = '2.5px';
                        } else {
                            elem.innerHTML = timeLeft;
                        }
                        timeLeft--;
                    }
                }
            });
        </script>
        </body>
        </html>";
    }
} else {
    if (!empty($_REQUEST['omiseToken'])) {
        $key_token = $_REQUEST['omiseToken'];
        $url = 'https://api.omise.co/charges';
        $type_omise = 1;
    } else if (!empty($_REQUEST['omiseSource'])) {
        $key_token = $_REQUEST['omiseSource'];
        $url = 'https://api.omise.co/sources/' . $key_token;
        $type_omise = 2;
    }
    require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';
    define('OMISE_API_VERSION', '2019-05-29');
    define('OMISE_PUBLIC_KEY', $public_key);
    define('OMISE_SECRET_KEY', $secret_key);

    if (!empty($type_omise)) {
        switch ($type_omise) {
            case (1):
                $charge = \OmiseCharge::create(
                    array(
                        'amount' => 15000,
                        'currency' => 'THB',
                        'card' => $key_token,
                        'description' => 'ทดสอบ',
                    )
                );
                break;
            case (2):
                $source = \OmiseSource::create(
                    array(
                        'amount' => 15000,
                        'currency' => 'THB',
                        'type' => 'promptpay'
                    )
                );

                $charge2 = \OmiseCharge::create(
                    array(
                        'amount' => 15000,
                        'currency' => 'THB',
                        'return_uri' => 'https://photobooth.versemedia.io/php/payment/checkout.php?source=' . $source['id'],
                        'source' => $source['id'],
                    )
                );

                $_SESSION['charge_id'] = $charge2['id'];
                $img_qr = $charge2['source']['scannable_code']['image']['download_uri'];

                if ($charge2['status'] == 'successful') {
                    echo "<img src='" . $img_qr . "'  >";
                } else if ($charge2['status'] == 'pending') {
                    echo "<img src='" . $img_qr . "'  >";
                    header("location: " . $charge2['authorize_uri']);
                    exit(0);
                }
                break;
        }
    }
}
?>

<!-- เช็ค status ทุก 5 วิ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment</title>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const checkStatus = () => {
                fetch('check_status.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'successful') {
                            window.location.href = '../../selectframe.html?charge_id=' + data.charge_id;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            };

            // Check status every 5 seconds
            setInterval(checkStatus, 5000);
        });
    </script>
</body>

</html>