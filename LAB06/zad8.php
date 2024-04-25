<?php
    function KapibaraJeMarchewke() {
        $random = rand(1, 10);
        if($random <= 6) 
            return true;
        else return false;
    }
?>

<html>
<head>
    <style>
        div {
            display: flex;
        }
        img {
            height: 100px;
        }
    </style>
</head>
<body>
    <div>
        <img src="https://t4.ftcdn.net/jpg/05/52/82/11/360_F_552821106_RVVWBchtNowOCZIEZHqx04BGzz1Jz0KG.jpg" alt="kapibara">

        <?php if(KapibaraJeMarchewke()) : ?>
            <img src="https://png.pngtree.com/png-vector/20190305/ourmid/pngtree-fresh-carrot-image-png-image_727953.jpg" alt=marchew>
        <?php endif; ?>
    </div>
</body>
</html>
