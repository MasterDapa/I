class NotaZakat {
    public function generateNota($jenisZakat, $jumlahHarta) {
        $result = [];

        switch ($jenisZakat) {
            case "penghasilan":
                $jumlahSumbangan = $jumlahHarta * 0.025; // 2.5% dari jumlah harta
                $result = [
                    "Jenis Zakat" => "Penghasilan",
                    "Jumlah Harta" => $jumlahHarta,
                    "Jumlah Sumbangan" => $jumlahSumbangan,
                    "Ucapan Terimakasih" => "Terima kasih atas sumbangan Zakat Penghasilan Anda.",
                ];
                break;

            case "tabungan":
                $jumlahSumbangan = $jumlahHarta * 0.025; // 2.5% dari jumlah harta
                $result = [
                    "Jenis Zakat" => "Tabungan",
                    "Jumlah Harta" => $jumlahHarta,
                    "Jumlah Sumbangan" => $jumlahSumbangan,
                    "Ucapan Terimakasih" => "Terima kasih atas sumbangan Zakat Tabungan Anda.",
                ];
                break;

            case "dagangan":
                $keuntunganSetahun = $_POST["annual-profit"];
                $modalAwal = $_POST["initial-capital"];
                $jumlahHarta = ($keuntunganSetahun - $modalAwal) * 0.025; // 2.5% dari keuntungan setahun
                $result = [
                    "Jenis Zakat" => "Dagangan",
                    "Modal Awal" => $modalAwal,
                    "Jumlah Harta" => $jumlahHarta,
                    "Jumlah Sumbangan" => $jumlahSumbangan,
                    "Ucapan Terimakasih" => "Terima kasih atas sumbangan Zakat Dagangan Anda.",
                ];
                break;

            case "emas":
                $jumlahSumbangan = $jumlahHarta * 0.025; // 2.5% dari jumlah harta
                $result = [
                    "Jenis Zakat" => "Emas",
                    "Jumlah Harta" => $jumlahHarta,
                    "Jumlah Sumbangan" => $jumlahSumbangan,
                    "Ucapan Terimakasih" => "Terima kasih atas sumbangan Zakat Emas Anda.",
                ];
                break;
        }

        return $result;
    }
}
