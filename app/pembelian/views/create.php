<?php
require_once 'app/functions/MY_model.php';
$tb_pembelian = get("SELECT pb.*, d.nama_distributor, u.nama_user
            FROM tb_pembelian pb
            INNER JOIN tb_det_pembelian dpb ON pb.id = dpb.pembelian_id
            INNER JOIN tb_distributor d ON pb.distributor_id = d.id 
            INNER JOIN tb_user u  ON pb.user_id = u.id
            ");

// Ambil daftar obat dari database
$tb_obat = get("SELECT * FROM tb_obat");
$obat_json = json_encode($tb_obat);

// Ambil daftar distributor dari database
$tb_distributor = get("SELECT * FROM tb_distributor");

// Ambil daftar user dari database
$tb_user = get("SELECT * FROM tb_user");

// Ambil daftar satuan dari database
$tb_satuan = get("SELECT * FROM tb_satuan");
$satuan_json = json_encode($tb_satuan);

?>

<div class="content-header row">
  <div class="content-header-right col-md-12">
    <a href="?page=pembelian" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card"> 
        <div class="card-header">
          <h4 class="card-title">Tambah Pembelian</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/pembelian/proses/create.php" method="post">
              <div class="form-body">
                <class="row">
                  <!--faktur pembelian  -->
                <div class="faktur-pembelian">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>No. Faktur</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="No. Faktur" class="form-control" name="no_faktur" required>
                      </div>

                      <div class="col-md-4">
                      <label for="ppn_option">PPN:</label>
                      </div>
                      <div class="col-md-8">
                      <input type="radio" id="ppn_termasuk" name="ppn_option" value="ppn_termasuk" class="ppn-option">
                      <label for="ppn_termasuk">PPN Termasuk</label>
                      <input type="radio" id="ppn_ditambahkan" name="ppn_option" value="ppn_ditambahkan" class="ppn-option">
                      <label for="ppn_ditambahkan">PPN Ditambahkan</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end faktur pembelian -->

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Pembelian</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Pembelian" class="form-control" name="tgl_pembelian" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Jatuh Tempo</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Jatuh Tempo" class="form-control" name="tgl_jatuh_tempo" required>
                      </div>
                    </div>
                  </div>

                  <!-- Menu per obat -->
                  <div id="menu-obat" class="col-12">
                    <div class="obat-form">
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Obat</label>
                        </div>
                        <div class="col-md-6">
                          <select class="form-control" name="obat[0][id]" onchange="setObatId(this)" id="id" required>
                            <?php foreach ($tb_obat as $obat) : ?>
                              <option value="<?php echo $obat['id']; ?>"><?php echo $obat['nama_obat']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-primary btn-sm" onclick="tambahObat()">Tambah</button>
                        </div>
                      </div>

                      <!-- Tambahkan input hidden untuk menyimpan nilai id obat -->
                      <input type="hidden" class="obat-id" name="obat[0][id]" value="">

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Nomor Batch</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="obat[0][batch]" id="batch" required>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onclick="hapusObat(this)">Hapus</button>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Tanggal Expired</label>
                        </div>
                        <div class="col-md-6">
                          <input type="date" class="form-control" name="obat[0][exp]" id="exp" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Qty</label>
                        </div>
                        <div class="col-md-6">
                          <input type="number" class="form-control" name="obat[0][qty]" id="qty" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Satuan</label>
                        </div>
                        <div class="col-md-6">
                          <select class="form-control" name="obat[0][satuan]" onchange="setSatuanId(this)" id="satuan" required>
                            <?php foreach ($tb_satuan as $satuan) : ?>
                              <option value="<?php echo $satuan['id']; ?>"><?php echo $satuan['nama_satuan']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Harga</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="obat[0][harga]" id="harga" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Diskon %</label>
                        </div>
                        <div class="col-md-6">
                          <input type="number" class="form-control" name="obat[0][diskon]" id="diskon" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Potongan</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="obat[0][potongan]" id="potongan" required readonly>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Total Harga</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="obat[0][total_harga]" id="total_harga" required readonly>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Akhir menu per obat -->

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>PPN</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="ppn" id="ppn" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Tagihan</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="total_tagihan" id="total_tagihan" required readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Bayar</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="total_bayar" id="total_bayar" required onchange="hitungkembalian()">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Sisa Pembayaran</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="sisa_bayar" id="sisa_bayar" required readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Status</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control" name="status" required>
                          <?php
                          // Ambil opsi status dari database
                          $statusOptions = ["LUNAS", "BELUM LUNAS"];

                          // Loop melalui setiap opsi status
                          foreach ($statusOptions as $option) {
                            echo '<option value="' . $option . '">' . $option . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Distributor</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control" name="distributor" required>
                          <?php foreach ($tb_distributor as $distributor) : ?>
                            <option value="<?php echo $distributor['id']; ?>"><?php echo $distributor['nama_distributor']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Karyawan</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control" name="user" required>
                          <?php foreach ($tb_user as $user) : ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo $user['nama_user']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
// Inisialisasi counter
var counter = 1;

// Fungsi untuk mengambil data obat dari database
function getObatList() {
  return JSON.parse('<?php echo addslashes($obat_json); ?>');
}

// Fungsi untuk membuat opsi pilihan obat dalam elemen select
function populateObatOptions(selectElement) {
  var obatList = getObatList();

  // Hapus semua opsi pilihan yang ada sebelumnya
  selectElement.innerHTML = '';

  // Tambahkan opsi pilihan "Pilih Obat" sebagai opsi default
  var defaultOption = document.createElement('option');
  defaultOption.value = '';
  defaultOption.text = 'Pilih Obat';
  selectElement.appendChild(defaultOption);

  // Tambahkan opsi pilihan obat dari daftar obat
  obatList.forEach(function(obat) {
    var option = document.createElement('option');
    option.value = obat.id;
    option.text = obat.nama_obat;
    selectElement.appendChild(option);
  });
}

// Panggil fungsi populateObatOptions() saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
  var select = document.querySelector('[name="obat[0][id]"]');
  populateObatOptions(select);
});

// Fungsi untuk menambahkan formulir obat baru
function tambahObat() {
  counter++;
  var index = counter - 1;

  var lastObatForm = document.querySelector('.obat-form:last-child');
  var newObatForm = lastObatForm.cloneNode(true);

  var inputs = newObatForm.getElementsByTagName('input');
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].name = 'obat[' + index + '][' + inputs[i].id + ']';
  }

  var selects = newObatForm.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) {
    selects[i].name = 'obat[' + index + '][' + selects[i].id + ']';
    selects[i].setAttribute('data-satuan', 'obat[' + index + '][satuan]');
  }

  // Hapus nilai input di formulir obat baru
  var qtyInput = newObatForm.querySelector('[name="obat[' + index + '][qty]"]');
  qtyInput.value = '';

  // Tambahkan formulir obat baru ke dalam menu obat
  var menuObat = document.getElementById('menu-obat');
  menuObat.appendChild(newObatForm);

  // Perbarui opsi pilihan obat dalam formulir obat baru
  var selectElement = newObatForm.querySelector('[name="obat[' + index + '][id]"]');
  populateObatOptions(selectElement);
}

// Fungsi untuk menghapus formulir obat
function hapusObat(button) {
  var menuObat = button.closest('.col-12');
  var obatForms = menuObat.getElementsByClassName('obat-form');

  if (obatForms.length > 1) {
    button.closest('.obat-form').remove();
    counter--;
    hitungTotalHarga();
  }
}

// Fungsi untuk mengatur nilai id obat yang dipilih
function setObatId(select) {
  var obatId = select.value;
  var inputId = select.closest('.obat-form').querySelector('.obat-id');
  inputId.value = obatId;
}

// Fungsi untuk mengatur nilai satuan id obat yang dipilih
function setSatuanId(select) {
  var satuanId = select.value;
  var inputId = select.closest('.obat-form').querySelector('.satuan-id');
  var index = select.closest('.obat-form').dataset.index;
  inputId.value = satuanId;
}

// Fungsi untuk menghitung total harga
function hitungTotalHarga() {
  var total_harga = 0;
  var total_ppn = 0;

  // Menghitung total harga dan potongan untuk setiap obat
  var obatForms = document.getElementsByClassName('obat-form');
  for (var i = 0; i < obatForms.length; i++) {
    var qtyObat = parseInt(obatForms[i].querySelector('[name="obat[' + i + '][qty]"]').value);
    var hargaObat = parseInt(obatForms[i].querySelector('[name="obat[' + i + '][harga]"]').value);
    var diskonObat = parseInt(obatForms[i].querySelector('[name="obat[' + i + '][diskon]"]').value);
    var ppnOption = document.querySelector('.faktur-pembelian [name="ppn_option"]:checked').value;

    var potongan = (qtyObat * hargaObat * diskonObat) / 100;
    var totalHargaObat = qtyObat * hargaObat - potongan;

    // Menampilkan potongan harga pada input potongan
    var potonganInput = obatForms[i].querySelector('[name="obat[' + i + '][potongan]"]');
    potonganInput.value = potongan;

    // Menampilkan hasil perhitungan pada input total harga untuk setiap formulir obat
    var totalHargaInput = obatForms[i].querySelector('[name="obat[' + i + '][total_harga]"]');
    totalHargaInput.value = totalHargaObat;

    // Menghitung total harga dan total potongan
    total_harga += totalHargaObat;

    // Menghitung total PPN berdasarkan opsi PPN yang dipilih
    var ppnOptionInput = document.querySelector('.faktur-pembelian [name="ppn_option"]:checked');
    var total_ppn = 0;

    if (ppnOptionInput.value === 'ppn_termasuk') {
      var total_harga = parseFloat(document.getElementById('total_harga').value);
      total_ppn = total_harga * 0.11; // PPN 11%
    } else if (ppnOptionInput.value === 'ppn_ditambahkan') {
      var obatForms = document.getElementsByClassName('obat-form');
      for (var i = 0; i < obatForms.length; i++) {
        var ppnInput = obatForms[i].querySelector('.ppn');
        var ppnValue = parseFloat(ppnInput.value) || 0;
        total_ppn += ppnValue;
      }
    }

  var total_tagihan = total_harga + total_ppn;

  // Menampilkan hasil perhitungan pada input total harga
  document.getElementById('total_harga').value = total_harga;

  // Menampilkan hasil perhitungan pada input total PPN
  document.getElementById('total_ppn').value = total_ppn;

  // Menampilkan hasil perhitungan pada input total tagihan
  document.getElementById('total_tagihan').value = total_tagihan;

  // Memanggil fungsi hitungkembalian() untuk mengupdate nilai kembalian
  hitungkembalian();
}
}

// Memanggil fungsi hitungTotalHarga() setiap kali nilai input berubah
var obatForms = document.getElementsByClassName('obat-form');
for (var i = 0; i < obatForms.length; i++) {
  var inputs = obatForms[i].getElementsByTagName('input');
  for (var j = 0; j < inputs.length; j++) {
    inputs[j].addEventListener('change', hitungTotalHarga);
  }
}

// Fungsi untuk menghitung kembalian
function hitungkembalian() {
  var total_bayar = parseFloat(document.getElementById('total_bayar').value);
  var total_tagihan = parseFloat(document.getElementById('total_tagihan').value);
  var sisa_bayar = total_tagihan - total_bayar;

  // Menampilkan hasil perhitungan pada input sisa pembayaran
  document.getElementById('sisa_bayar').value = sisa_bayar;

  // Set kembali dalam format mata uang Rupiah
  var rupiah = document.getElementById('sisa_bayar');
  rupiah.value = formatRupiah(sisa_bayar.toString(), 'Rp. ');
}

// Memanggil fungsi hitungkembalian() setelah halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
  hitungkembalian();
});

// Fungsi untuk mengubah format angka menjadi format mata uang Rupiah
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString();
  var split = number_string.split(',');
  var sisa = split[0].length % 3;
  var rupiah = split[0].substr(0, sisa);
  var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // Tambahkan titik jika yang diinput sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix === undefined ? rupiah : rupiah ? 'Rp.' + rupiah : '';
}



</script>
