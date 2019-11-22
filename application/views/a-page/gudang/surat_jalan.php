<?php
$price = number_format($detail_order['price'], 0, ',', '.');
$harga = $detail_order['price'] * $detail_order['qty'] + $detail_order['service'];
$subtotal = number_format($harga, 0, ',', '.');

$service = number_format($detail_order['service'], 0, ',', '.');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Jalan : SJA.<?= time(); ?></title>

  <style>
    .header {
      border: 1px solid black;
      padding: 5px;
      padding-bottom: 17px;
      margin-bottom: 30px;
    }

    .titleD {
      font-size: 14px;
      font-weight: bold;
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <h3 style="text-align: center;">SURAT JALAN PENJUALANAN BARANG</h3>
  <div class="header">
    <div class="header-content">
      <table cellspacing="0" cellpadding="5">
        <tr>
          <td><b>Faktur</b></td>
          <td></td>
          <td>FA-<?= $detail_order['id_transaksi']; ?>-<?= $detail_order['date_confirm']; ?></td>
        </tr>

        <tr>
          <td><b>Tanggal</b></td>
          <td></td>
          <td><?= date('d F Y', time()); ?></td>
        </tr>

        <tr>
          <td><b>Nama Kasir</b></td>
          <td></td>
          <td><?= $admin['fullname']; ?></td>
        </tr>

        <tr>
          <td><b>Surat Jalan</b></td>
          <td></td>
          <td>SJA.<?= $detail_order['id_transaksi'] . '/' . time(); ?></td>
        </tr>
      </table>

      <table style="margin-left: 60%;margin-top: -16%;" cellpadding="5">
        <tr>
          <td><b>Nama</b></td>
          <br><br>
          <td></td>
          <td><?= strtoupper($user['fullname']); ?></td>
        </tr>
        <br><br>
        <tr>
          <td><b>Alamat</b></td>
          <td></td>
          <td><?= $user['address']; ?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="body">
    <div class="row">
      <div class="titleD"><i>Detail Pembelian</i></div>
      <table border="1" cellspacing="0" cellpadding="5" style="text-align: center;width:100%;">
        <thead>
          <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Jumlah Jual</th>
            <th>Ongkir</th>
            <th>Subtotal</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>PR/<?= $detail_order['id_product'] . '/' . $detail_order['product_arrive']; ?></td>
            <td><?= $detail_order['product_name']; ?></td>
            <td>Rp <?= $price; ?></td>
            <td><?= $detail_order['qty']; ?></td>
            <td>Rp <?= $service; ?></td>
            <td>Rp <?= $subtotal; ?></td>
          </tr>

          <tr style="border:none;background-color: lightgray;">
            <th colspan="3">Total</th>
            <th colspan="3">Rp <?= $subtotal; ?></th>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row">
      <div class="titleD" style="margin-top: 30px;">Detail Pembayaran</div>
      <table border="1" cellspacing="0" cellpadding="5" style="text-align: center;width:100%;">
        <tr style="background-color: lightgray;">
          <td>BANK</td>
          <td>TANGGAL</td>
          <td>KODE MUTASI</td>
          <td>BERITA</td>
          <td>CREDIT</td>
        </tr>

        <tr>
          <td><?= strtoupper($bank['bank_name']); ?></td>
          <td><?= date('d-M-Y', $detail_order['date_confirm']); ?></td>
          <td>-</td>
          <td>TRANSFER FROM <br><?= strtoupper($user['fullname']); ?>, DATE <?= date('d/m/Y', $detail_order['date_confirm']) ?></td>
          <td>Rp <?= $subtotal; ?></td>
        </tr>

        <tr>
          <th colspan="4" style="background-color: lightgray;">Total</th>
          <th style="background-color: lightgray;">Rp. <?= $subtotal; ?></th>
        </tr>
      </table>
    </div>

    <div class="row">
      <table cellspacing="0" cellpadding="10" style="border: 1px solid black;margin-top:3%;margin-left: 49%;width:100%;">
        <tr>
          <td>TOTAL PENJUALANAN</td>
          <td>:</td>
          <td>Rp <?= $subtotal; ?></td>
        </tr>

        <tr>
          <td>TOTAL PEMBAYARAN</td>
          <td>:</td>
          <td>Rp <?= $subtotal; ?></td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>