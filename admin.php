<?php
include './php/connect_sql.php';

session_start();

if (isset($_GET['logout']) == 'yes') {
    session_destroy();
    header("Location: ./index.html");
}

if (!isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Access Denied</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .p2 {
            color: #7d5a5a;
        }
    </style>

    <body>
        <h2 class="text-center">Access Denied</h2>
        <p class="text-center p2">Made with 💖 by qualityroom</p>
    </body>

    </html>
    <script>
        setTimeout(function() { // wait for 5 secs(2)
            window.location.href = "./index.html";
        }, 5000);
    </script>
<?php } else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet"> -->
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;400;600&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <title>VersePhotobooth Admin</title>
        <link rel="icon" href="./image/QRS.png">
        <meta property="og:title" content="Verse Photo Booth">
        <meta property="og:description" content="Made with heart by Qualityroom">
        <meta property="og:image" content="./image/QRS.png">
        <meta property="og:url" content="https://www.photobooth.catangelz.com/">

    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
        .table-responsive {
            margin-left: 2vw;
            margin-right: 2vw;
            margin-top: 1vh;
            margin-bottom: 1vh;
        }

        ::-webkit-scrollbar {
            background: transparent;
            width: 0;
        }

        #comment {
            text-align: center;
            margin-top: 1.5vh;
            font-size: 100%;
        }

        body {
            font-family: 'Prompt', sans-serif;
        }

        img {
            max-height: 100px;
        }

        input[type=checkbox] {
            transform: scale(2);
        }

        td {
            height: 50px;
            vertical-align: text-top;
        }

        img {
            transition: .25s ease-out;
            object-fit: fill;
        }

        img:hover {
            transform: scale(3);
            top: 50%;
            left: 50%;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15), 0 2px 4px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.15), 0 8px 16px rgba(0, 0, 0, 0.15), 0 16px 32px rgba(0, 0, 0, 0.15);
            object-fit: cover;
        }

        #print {
            position: fixed;
            z-index: 999;
            right: 0;
            bottom: 0;
            transform: scale(4);
            margin-right: 14vh;
            margin-bottom: 20vh;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.25);
        }
    </style>

    <body>
        <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="3%" class="text-center">เลือก</th>
                        <th class="text-center">ลำดับ</th>
                        <!-- <th class="text-center">เฟรม</th> -->
                        <th class="text-center">รูป</th>
                        <th class="text-center">QR Code</th>
                        <th class="text-center">วันที่ถ่าย</th>
                        <th class="text-center">เวลาที่ถ่าย</th>
                        <th class="text-center">จำนวนการพรินต์</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                </tbody>
            </table>
        </div>
        <button class="btn btn-danger" id="print">Print <i class="fa fa-print"></i></button>
        <div style="text-align: center;"><a class="btn btn-info" href="./php/logout.php">Logout</a></div>
        <p id="comment">Made with 💖 by qualityroom</p>
    </body>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#myTable").DataTable({

                ajax: {
                    url: './php/list_fetch.php',
                    dataSrc: ""
                },
                columns: [{
                        data: "ID"
                    },
                    {
                        data: "ID"
                    },
                    //{data: "frame" },
                    {
                        data: "filename"
                    },
                    {
                        data: "url"
                    },
                    {
                        data: "date"
                    },
                    {
                        data: "time"
                    },
                    {
                        data: "printcount"
                    },

                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        //var color = 'black';
                        //let str = data;

                        return '<input type="checkbox" id="' + data + '" value="' + data + '" onclick="check();">';

                    }
                }, {
                    targets: 2,
                    render: function(data, type, row) {
                        //var color = 'black';
                        //let str = data;

                        return '<img src="./img/' + data + '.png"></img>';

                    }
                }, {
                    targets: 3,
                    render: function(data, type, row) {
                        //var color = 'black';
                        //let str = data;

                        return '<img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=https://photobooth.versemedia.io/img.html?img=' + data + '" val="' + data + '" onclick="Test(\'' + data + '\')"></img>';

                    }
                }],
                "language": {
                    "processing": "กำลังดำเนินการ...",
                    "lengthMenu": "แสดง _MENU_ แถว",
                    "zeroRecords": "ไม่พบข้อมูลจ้า",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "infoEmpty": "ยังไม่มีข้อมูลจ้า",
                    "infoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "search": "ค้นหา:",
                    "paginate": {
                        "first": "เริ่มต้น",
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป",
                        "last": "สุดท้าย"
                    }
                },
                "order": [
                    [1, "desc"]
                ]

            });

        });
    </script>
    <script>
        function Test(url) {
            window.open("/img.html?img=" + url);
        }
    </script>
    <script>
        var checkbox1Value = "";
        var checkbox2Value = "";

        function check() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            if (checkedCheckboxes.length <= 2 && checkedCheckboxes.length != 0) {
                if (checkedCheckboxes.length === 1) {
                    var checkbox1Value = checkedCheckboxes[0].value;
                    var checkbox2Value = 'NOSELECTED';
                } else if (checkedCheckboxes.length === 2) {
                    var checkbox1Value = checkedCheckboxes[0].value;
                    var checkbox2Value = checkedCheckboxes[1].value;
                }
                // Get the values of the checked checkboxes


                console.log(checkbox1Value + checkbox2Value);
            } else if (checkedCheckboxes.length >= 3) {
                document.getElementById(checkedCheckboxes[2].value).checked = false;
            }
        }

        function print() {
            /*var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            if (checkedCheckboxes.length === 2) {
            // Get the values of the checked checkboxes
            var checkbox1Value = checkedCheckboxes[0].value;
            var checkbox2Value = checkedCheckboxes[1].value;
            }
            window.open('print.php?img1='+checkbox1Value+'&img2='+checkbox2Value,'_blank')*/
        }
        $('#print').on('click', function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            if (checkedCheckboxes.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: "Please select at least 1 picture before printing.",
                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            if (checkedCheckboxes.length === 1) {
                Swal.fire({
                    title: 'You have selected only 1 image',
                    text: "Are you sure you want to print it?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, print it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "./php/print.php",
                            data: {
                                pic1: checkbox1Value,
                                pic2: checkbox2Value
                            },
                            success: function(data) {
                                var objJSON = JSON.parse(data);
                                console.log(objJSON.img1);
                                console.log(objJSON.img2);

                                var printContent = document.getElementById("selected-images-container");
                                var windowUrl = 'about:blank';
                                var uniqueName = new Date();
                                var windowName = 'Print' + uniqueName.getTime();

                                var printWindow = window.open(windowUrl, windowName, 'left=50000,top=50000,width=0,height=0');
                                printWindow.document.write('<html><head><title>Print Page</title>');
                                printWindow.document.write('<style type="text/css">');
                                printWindow.document.write('@media print {');
                                printWindow.document.write('body, html { margin: 0; padding: 0; width: 100%; height: 100%; }');
                                printWindow.document.write('img { width: 100%; height: 100%; ');
                                printWindow.document.write('}');
                                printWindow.document.write('</style>');
                                printWindow.document.write('</head><body><div class="selected-images-container">');
                                printWindow.document.write('<img src="./img/' + objJSON.img1 + '"></img>');
                                // printWindow.document.write('<img src="./img/' + objJSON.img2 + '"></img>');
                                //printWindow.document.write(printContent.innerHTML);
                                printWindow.document.write('</div></body></html>');
                                printWindow.document.close();
                                //printWindow.document.write(printContent.innerHTML);
                                printWindow.document.close();
                                printWindow.focus();
                                printWindow.print();
                                printWindow.onafterprint = () => printWindow.close();
                                setTimeout(function() {
                                    printWindow.close();
                                }, 3000);
                                // printWindow.close();

                                Swal.fire({
                                    icon: 'success',
                                    title: "<b>Printed!</b>",
                                    text: 'Please wait a second, and then continue printing.',
                                    footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            }

                        })
                    }
                })
                var checkbox1Value = checkedCheckboxes[0].value;
                var checkbox2Value = 'NOSELECTED';

            } else if (checkedCheckboxes.length === 2) {
                var checkbox1Value = checkedCheckboxes[0].value;
                var checkbox2Value = checkedCheckboxes[1].value;

                $.ajax({
                    type: "POST",
                    url: "./php/print.php",
                    data: {
                        pic1: checkbox1Value,
                        pic2: checkbox2Value
                    },
                    success: function(data) {
                        var objJSON = JSON.parse(data);
                        console.log(objJSON.img1);
                        console.log(objJSON.img2);

                        var printContent = document.getElementById("selected-images-container");
                        var windowUrl = 'about:blank';
                        var uniqueName = new Date();
                        var windowName = 'Print' + uniqueName.getTime();

                        var printWindow = window.open(windowUrl, windowName, 'left=50000,top=50000,width=0,height=0');
                        printWindow.document.write('<html><head><title>Print Page</title>');
                        printWindow.document.write('<style type="text/css">');
                        printWindow.document.write('@media print {');
                        printWindow.document.write('body, html { margin: 0; padding: 0; width: 100%; height: 100%; }');
                        printWindow.document.write('img { width: 100%; height: 100%; ');
                        printWindow.document.write('}');
                        printWindow.document.write('</style>');
                        printWindow.document.write('</head><body><div class="selected-images-container">');
                        printWindow.document.write('<img src="./img/' + objJSON.img1 + '"></img>');
                        printWindow.document.write('<img src="./img/' + objJSON.img2 + '"></img>');
                        //printWindow.document.write(printContent.innerHTML);
                        printWindow.document.write('</div></body></html>');
                        printWindow.document.close();
                        //printWindow.document.write(printContent.innerHTML);
                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.onafterprint = () => printWindow.close();
                        setTimeout(function() {
                            printWindow.close();
                        }, 3000);
                        // printWindow.close();

                        Swal.fire({
                            icon: 'success',
                            title: "<b>Printed!</b>",
                            text: 'Please wait a second, and then continue printing.',
                            footer: '<p style="font-size:14px">Verse Media Techonology</p>',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }

                })
            }

        });
    </script>

    </html>
<?php } ?>