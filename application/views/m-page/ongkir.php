<div class="container">
  <div class="row py-5">
    <div class="col-md-12">
      <form>
        <label>Provinsi Asal</label>
        <select name="" onchange="get_kota('asal')" id="provinsi_asal" class="form-control provinsi">

        </select><br>

        <label>Kota Asal</label>
        <select name="" id="kota_asal" class="form-control">

        </select><br>

        <label>Provinsi Tujuan</label>
        <select name="" onchange="get_kota('tujuan')" id="provinsi_tujuan" class="form-control provinsi">

        </select><br>

        <label>Kota Tujuan</label>
        <select name="" id="kota_tujuan" class="form-control">
          
        </select><br>

        <label for="berat">Berat Barang (dibulatkan ke dalam Kg)</label>
        <input type="number" name="berat" id="berat" class="form-control"><br>

        <label for="kurir">Kurir</label>
        <select onChange="get_ongkir()" name="kurir" id="kurir" class="form-control">
          <option disabled hidden selected>Pilih Kurir</option>
          <option value="pos">POS</option>
          <option value="tiki">TIKI</option>
          <option value="jne">JNE</option>
        </select><br>

        <label for="service">service</label>
        <select name="service" id="service" class="form-control">

        </select>
      </form>
    </div>
  </div>
</div>