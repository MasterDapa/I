<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script>
        function showIncome() {
            document.getElementById("income-container").style.display = "block";
            document.getElementById("savings-container").style.display = "none";
            document.getElementById("trading-container").style.display = "none";
            document.getElementById("gold-container").style.display = "none";
            document.getElementById("jenis_zakat").value = "penghasilan";
            updateJumlahHarta("penghasilan");
        }

        function showSavings() {
            document.getElementById("income-container").style.display = "none";
            document.getElementById("savings-container").style.display = "block";
            document.getElementById("trading-container").style.display = "none";
            document.getElementById("gold-container").style.display = "none";
            document.getElementById("jenis_zakat").value = "tabungan";
            updateJumlahHarta("tabungan");
        }

        function showTrading() {
            document.getElementById("income-container").style.display = "none";
            document.getElementById("savings-container").style.display = "none";
            document.getElementById("trading-container").style.display = "block";
            document.getElementById("gold-container").style.display = "none";
            document.getElementById("jenis_zakat").value = "dagangan";
            updateJumlahHarta("dagangan");
        }

        function showGold() {
            document.getElementById("income-container").style.display = "none";
            document.getElementById("savings-container").style.display = "none";
            document.getElementById("trading-container").style.display = "none";
            document.getElementById("gold-container").style.display = "block";
            document.getElementById("jenis_zakat").value = "emas";
            updateJumlahHarta("emas");
        }

        function updateJumlahHarta(jenis) {
            var inputJumlahHarta = document.getElementById("jumlah_harta");
            var inputWajibBayar = document.getElementById("wajib_bayar");
            var jenisZakatInput = document.getElementById("jenis_zakat");

            jenisZakatInput.value = jenis;

            switch (jenis) {
                case "penghasilan":
                    inputJumlahHarta.placeholder = "Total Penghasilan (Rp.)";
                    break;
                case "tabungan":
                    inputJumlahHarta.placeholder = "Saldo Tabungan (Rp.)";
                    break;
                case "dagangan":
                    inputJumlahHarta.placeholder = "Total Dagangan (Rp.)";
                    break;
                case "emas":
                    inputJumlahHarta.placeholder = "Total Emas (gr)";
                    break;
                default:
                    inputJumlahHarta.placeholder = "Jumlah Harta";
            }

            var jumlahHarta = parseFloat(inputJumlahHarta.value);
            var wajibBayar = false;

            if (jenis === "penghasilan" && jumlahHarta > 91545000) {
                wajibBayar = true;
            } else if (jenis === "tabungan" && jumlahHarta > 46750000) {
                wajibBayar = true;
            } else if (jenis === "dagangan") {
                var modalAwal = parseFloat(prompt("Masukkan Modal Awal Dagangan (Rp.)"));
                if (jumlahHarta - modalAwal > 0) {
                    wajibBayar = true;
                }
            } else if (jenis === "emas" && jumlahHarta > 85) {
                wajibBayar = true;
            }

            inputWajibBayar.value = wajibBayar ? "Wajib Bayar" : "Tidak Wajib Bayar tapi Bisa Infaq";
        }

        function formatCurrency(element) {
            var value = element.value.replace(/[^\d]/g, '');
            if (value.length > 0) {
                value = "Rp. " + Number(value).toLocaleString();
            }
            element.value = value;

            var inputJumlahHarta = document.getElementById("jumlah_harta");
            inputJumlahHarta.value = Number(value.replace(/[^\d]/g, ''));
        }
    </script>
    <title>Kalkulator Zakat</title>
</head>
<body onload="showIncome()">
    <div class="header">
        <h1>Kalkulator Zakat</h1>
        <img src="logo.png" alt="Logo" class="logo">
    </div>

    <div class="container">
        <h2>Pilih Jenis Zakat</h2>
        <form method="post" action="proses.php">
            <div id="gambar-container">
                <img src="uang.jpeg" alt="Penghasilan" onclick="showIncome()">
                <span>Penghasilan</span>
                <img src="tabungan.png" alt="Tabungan" onclick="showSavings()">
                <span>Tabungan</span>
                <img src="dagangan.png" alt="Dagangan" onclick="showTrading()">
                <span>Dagangan</span>
                <img src="emas.jpeg" alt="Emas" onclick="showGold()">
                <span>Emas</span>
            </div>

            <div id="income-container">
                <label for="income-type">Pilih Periode:</label>
                <select name="income-type" id="income-type">
                    <option value="monthly">Per Bulan</option>
                    <option value="yearly">Per Tahun</option>
                </select>
                <br>
                <label for="income-amount">Jumlah Penghasilan:</label>
                <input type="text" name="income-amount" id="income-amount" placeholder="Masukkan Jumlah Penghasilan Anda" oninput="formatCurrency(this)">
            </div>

            <div id="savings-container" style="display: none;">
                <label for="savings-amount">Saldo Anda:</label>
                <input type="text" name="savings-amount" id="savings-amount" placeholder="Masukkan Jumlah Tabungan Anda" oninput="formatCurrency(this)">
            </div>

            <div id="trading-container" style="display: none;">
                <label for="initial-capital">Modal Awal:</label>
                <input type="text" name="initial-capital" id="initial-capital" placeholder="Masukkan Jumah Modal Anda" oninput="formatCurrency(this)">
                <br>
                <label for="annual-profit">Keuntungan Setahun:</label>
                <input type="text" name="annual-profit" id="annual-profit" placeholder="Masukkan Keuntungan Anda" oninput="formatCurrency(this)">
            </div>

            <div id="gold-container" style="display: none;">
                <label for="gold-amount">Jumlah Emas:</label>
                <input type="text" name="gold-amount" id="gold-amount" placeholder="Masukkan Total Berat Emas">
            </div>

            <input type="hidden" name="jenis_zakat" id="jenis_zakat">
            <input type="hidden" name="jumlah_harta" id="jumlah_harta">
            <input type="hidden" name="wajib_bayar" id="wajib_bayar">

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
