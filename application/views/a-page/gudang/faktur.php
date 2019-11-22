<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Faktur : FA-<?= $detail_order['id_transaksi']; ?>-<?= $detail_order['date_confirm']; ?></title>

  <style>
    .td-pen {
      border: 1px solid black;
      padding: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <table cellspacing="0" cellpadding="7">
        <tr>
          <td>NO.FAKTUR</td>
          <td>:</td>
          <td>FA-<?= $detail_order['id_transaksi']; ?>-<?= $detail_order['date_confirm']; ?></td>
        </tr>

        <tr>
          <td>NAMA CABANG</td>
          <td>:</td>
          <td><?= $gudangName['warehouse_name']; ?></td>
        </tr>

        <tr>
          <td>NAMA MEMBER</td>
          <td>:</td>
          <td><?= strtoupper($user['fullname']); ?></td>
        </tr>

        <tr>
          <td>TANGGAL PESANAN</td>
          <td>:</td>
          <td><?= date('d F Y', $detail_order['date_order']); ?></td>
        </tr>

        <tr>
          <td>NAMA PAKET</td>
          <td>:</td>
          <td>-</td>
        </tr>

        <tr>
          <td>KOFIRMASI</td>
          <td>:</td>
          <td>ADMIN/<?= $gudangName['warehouse_name'] . '/' . $admin['fullname'] . '/' . $detail_order['id_kasir']; ?></td>
        </tr>
      </table>
    </div><br><br>

    <div class="row">
      <b style="font-size: 15px;">Penjualanan</b>
      <table cellpadding="5" cellspacing="0" style="text-align: center;width:100%;">
        <tr style="background-color: lightgray;">
          <td class="td-pen">NO.SERIAL</td>
          <td class="td-pen">PRODUK</td>
          <td class="td-pen">HARGA</td>
          <td class="td-pen">QTY</td>
          <td class="td-pen">Weight</td>
          <td class="td-pen">TOTAL</td>
        </tr>

        <tr>
          <td class="td-pen"><?= $detail_order['id_transaksi'] . '/' . $detail_order['date_order']; ?></td>
          <td class="td-pen"><?= $detail_order['product_name']; ?></td>
          <td class="td-pen">
            <?php
            $subtotal = number_format($detail_order['price'], 0, ',', '.');
            ?>
            Rp <?= $subtotal; ?>
          </td>
          <td class="td-pen"><?= $detail_order['qty']; ?></td>
          <td class="td-pen"><?= $detail_order['weight']; ?> Kg x <?= $detail_order['qty']; ?> Plywood = <b><?= $detail_order['weight'] * $detail_order['qty']; ?>Kg</b></td>
          <td class="td-pen">
            <?php
            $pay_courier = $detail_order['service'] * $detail_order['total_weight'];
            $total_p = $detail_order['price'] * $detail_order['qty'] + $pay_courier;
            $harga   = number_format($total_p, 0, ',', '.');
            ?>
            Rp <?= $harga; ?>
          </td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="td-pen" style="background-color: lightgray;">Total</td>
          <td class="td-pen" style="background-color: lightgray;">Rp. <?= $harga; ?></td>
        </tr>
      </table>
    </div><br><br>

    <div class="row">
      <b style="font-size: 15px;">Pembayaran</b>

      <table cellspacing="0" cellpadding="4" style="text-align: center;width:100%;">
        <tr style="background-color: lightgray;">
          <td class="td-pen">BANK</td>
          <td class="td-pen">TANGGAL</td>
          <td class="td-pen">KODE MUTASI</td>
          <td class="td-pen">BERITA</td>
          <td class="td-pen">CREDIT</td>
        </tr>

        <tr>
          <td class="td-pen"><?= strtoupper($bank['bank_name']); ?></td>
          <td class="td-pen"><?= date('d-M-Y', $detail_order['date_confirm']); ?></td>
          <td class="td-pen">-</td>
          <td class="td-pen">TRANSFER FROM <br><?= strtoupper($user['fullname']); ?>, DATE <?= date('d/m/Y', $detail_order['date_confirm']) ?></td>
          <td class="td-pen">Rp <?= $harga; ?></td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td class="td-pen" style="background-color: lightgray;">Total</td>
          <td class="td-pen" style="background-color: lightgray;">Rp. <?= $harga; ?></td>
        </tr>
      </table>
    </div>

    <div class="row">
      <table cellspacing="0" cellpadding="10" style="border: 1px solid black;margin-top:3%;margin-left: 49%;width:100%;">
        <tr>
          <td>TOTAL PENJUALANAN</td>
          <td>:</td>
          <td>Rp <?= $harga; ?></td>
        </tr>

        <tr>
          <td>TOTAL PEMBAYARAN</td>
          <td>:</td>
          <td>Rp <?= $harga; ?></td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>