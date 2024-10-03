<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Total Pembelian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Hitung Total Pembelian</h2>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="total">Total Pembelian (Rp)</label>
                <input type="number" class="form-control" id="total" name="total" placeholder="Masukkan total pembelian" required>
            </div>
            <div class="form-group">
                <label for="member">Apakah Pembeli Member?</label>
                <select class="form-control" id="member" name="member" required>
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Hitung</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $total = $_POST['total'];
            $is_member = $_POST['member'] == 'yes';

            // Inisialisasi diskon
            $diskon = 0;

            // Jika pembeli adalah member
            if ($is_member) {
                $diskon += 10; // Diskon member 10%

                // Jika total pembelian >= 500.000, diskon tambahan 10%
                if ($total >= 500000) {
                    $diskon += 10;
                } elseif ($total >= 300000) {
                    // Jika total pembelian >= 300.000, diskon tambahan 5%
                    $diskon += 5;
                }
            } else {
                // Jika pembeli bukan member
                if ($total >= 500000) {
                    $diskon += 10; // Diskon 10% jika total >= 500.000
                }
            }

            // Hitung total setelah diskon
            $total_diskon = ($diskon / 100) * $total;
            $total_akhir = $total - $total_diskon;

            echo "<div class='mt-4 alert alert-info'>";
            echo "<h4>Hasil Perhitungan:</h4>";
            echo "<p>Total Pembelian: Rp " . number_format($total, 0, ',', '.') . "</p>";
            echo "<p>Diskon: $diskon%</p>";
            echo "<p>Total Diskon: Rp " . number_format($total_diskon, 0, ',', '.') . "</p>";
            echo "<p>Total Akhir: Rp " . number_format($total_akhir, 0, ',', '.') . "</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>
