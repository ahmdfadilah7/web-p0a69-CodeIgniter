<?php
    function rupiah($rupiah) {
        $hasil = 'Rp'.number_format($rupiah, 0, ',', '.');

        return $hasil;
    }

    function rupiah_v2($rupiah) {
        $hasil = 'Rp'.number_format($rupiah, 2, ',', '.');

        return $hasil;
    }
?>