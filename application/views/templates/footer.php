  <script src="<?= base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> -->
  <script src="<?= base_url('assets/js/Chart.js'); ?>"></script>
  <script src="<?= base_url('assets/js/chart.js'); ?>"></script>
  <script src="<?= base_url('assets/js/parallax.js'); ?>"></script>
  <script src="<?= base_url('assets/js/myJs.js'); ?>"></script>
  <script>
    $(document).ready(function() {
      // ambil ongkir
      $.get("<?= base_url('ongkir/get_provinsi') ?>", {}, (response) => {
        let output = '';
        let provinsi = response.rajaongkir.results;
        console.log(response);

        provinsi.map((val, i) => {
          output += `<option value="${val.province_id}">${val.province}</option>`
        })
        $('.provinsi').html(output);
      });
    });

    // fungsi get kota
    function get_kota(type) {
      let id_provinsi = $(`#provinsi_${type}`).val();

      $.get("<?= base_url('ongkir/get_kota/') ?>" + id_provinsi, {}, (response) => {
        let output = '';
        let kota = response.rajaongkir.results;
        console.log(response);

        kota.map((val, i) => {
          output += `<option value="${val.city_id}">${val.city_name}</option>`
        });
        $(`#kota_${type}`).html(output);
      })
    }

    // fungsi get ongkir
    function get_ongkir() {
      let berat = $('#berat').val();
      let asal = $('#kota_asal').val();
      let tujuan = $('#kota_tujuan').val();
      let kurir = $('#kurir').val();
      let output = '';

      $.get("<?= base_url('ongkir/get_biaya/') ?>" + `${asal}/${tujuan}/${berat}/${kurir}`, {}, (response) => {
        // console.log(response);
        let output = '';
        let biaya = response.rajaongkir.results;
        console.log(biaya);

        biaya.map((val, i) => {
          for (var i = 0; i < val.costs.length; i++) {
            let jenis_layanan = val.costs[i].service;
            val.costs[i].cost.map((val, i) => {
              output += `<option value="${val.value}">${jenis_layanan} | Rp. ${val.value} | ${val.etd} Hari</option>`
            })
          }
        });
        $(`#service`).html(output);
      })
    }
  </script>
  </body>

  </html>