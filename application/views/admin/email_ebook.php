<html>
<head>
    <style type='text/css'>
        body {font-family: cursive}
    </style>
</head>
<body>
    <img src="https://pbs.twimg.com/profile_images/1284530341680574464/EgSYp6in_400x400.jpg" style="height: 100px; width: 100px;">
    <div class="row mt-4">
        <div class="col">
            <h1 style="margin-bottom: -5px; font-family:cursive;"> Hai, <?= $pesanan['nama_penerima']; ?></h1>
            <h2 style="font-family:cursive;">Pembelian E-Book Berhasil !!!</h2>
        </div>
        
    </div>
    <div class="row mt-4">
        <div class="col-sm-5">
            <p style="font-family:cursive;">
            Terima kasih telah melakukan pembelian E-book <?= $pesanan['nama_merch']; ?> Berikut link untuk mengakses E-book tersebut :<br>
            <a href="<?= $pesanan['linkebook']; ?>"><?= $pesanan['linkebook']; ?></a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="" style="float:right">
            <h2 style="margin-bottom: -2px;">Regards,</h2>
            Intrvrt.me
        </div>
    </div>
</body>
</html>