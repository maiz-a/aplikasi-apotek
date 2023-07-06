<?php
require_once 'app/functions/MY_model.php';
$tb_penjualan = get("SELECT pj.*, k.nama_karyawan
            FROM tb_penjualan pj
            INNER JOIN tb_det_penjualan dpj ON pj.id = dpj.penjualan_id
            INNER JOIN tb_karyawan k ON pj.karyawan_id = k.id
            ");

// Ambil daftar obat dari database
$tb_obat = get("SELECT * FROM tb_obat");
$obat_json = json_encode($tb_obat);

// Ambil daftar karyawan dari database
$tb_karyawan = get("SELECT * FROM tb_karyawan");

// Ambil daftar no_batch dari database
$tb_batch = get("SELECT * FROM tb_batch");
$batch_json = json_encode($tb_batch);

// Ambil daftar satuan dari database
$tb_satuan = get("SELECT * FROM tb_satuan");
$satuan_json = json_encode($tb_satuan);

// Mengenerate nomor struk secara otomatis
$no_struk = generateNoStruk($conn);

// Mendefinisikan alamat URL ke file get_batch_data.php
$getBatchDataUrl = 'app/penjualan/views/get_batch_data.php';


?>

<div class="content-header row">
  <div class="content-header-right col-md-12">
    <a href="?page=penjualan" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tambah Penjualan</h4>
        </div>

        <div class="card-content">
          <div class="card-body">
            <form action="app/penjualan/proses/create.php" method="post">
              <div class="form-body">
                <class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>No. Struk </label>
                      </div>
                      <div class="col-md-8">
                      <input type="text" placeholder="No. Struk" class="form-control" name="no_struk" value="<?php echo $no_struk; ?>" readonly>
                    </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Penjualan</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Penjualan" class="form-control" name="tgl_penjualan" required>
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
                        <select class="form-control obat-id" name="obat[0][id]" onchange="setObatId(this)" id="id" required>
                          <?php foreach ($tb_obat as $obat) : ?>
                            <option value="<?php echo $obat['id']; ?>"><?php echo $obat['nama_obat']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-primary btn-sm" onclick="tambahObat()">Tambah</button>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Nomor Batch</label>
                        </div>
                        <div class="col-md-6">
                        <select class="form-control no-batch" name="obat[0][no_batch]" onchange="setBatchId(this)" id="no_batch" required>
                          <option value="">Pilih Nomor Batch</option>
                        </select>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onclick="hapusObat(this)">Hapus</button>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Qty</label>
                        </div>
                        <div class="col-md-6">
                          <input type="number" class="form-control" name="obat[0][qty_tablet]" id="qty_tablet" required>
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

                  </div>
                </div>

                    <!-- Menu per obat --> 
                    <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Harga</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="total_harga" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Bayar</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="total_bayar" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Sisa Kembalian</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="kembali" required>
                      </div>
                    </div>
                  </div>

              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Karyawan</label>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control" name="karyawan" required>
                      <?php foreach ($tb_karyawan as $karyawan) : ?>
                        <option value="<?php echo $karyawan['id']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
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
  obatList.forEach(function (obat) {
    var option = document.createElement('option');
    option.value = obat.id;
    option.text = obat.nama_obat;
    selectElement.appendChild(option);
  });
}

// Panggil fungsi populateObatOptions() saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
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
    selects[i].onchange = function () {
      setBatchId(this);
    };
  }

  var menuObat = document.getElementById('menu-obat');
  menuObat.appendChild(newObatForm);
}

// Fungsi untuk menghapus formulir obat
function hapusObat(button) {
  var menuObat = button.closest('.col-12');
  var obatForms = menuObat.getElementsByClassName('obat-form');

  if (obatForms.length > 1) {
    button.closest('.obat-form').remove();
    counter--;
  }
}

// Fungsi untuk mengatur nilai id obat yang dipilih
function setObatId(select) {
  var obatId = select.value;
  var inputId = select.closest('.obat-form').querySelector('.obat-id');
  inputId.value = obatId;

  // Panggil fungsi untuk mengupdate opsi nomor batch
  setBatchId(select);
}

function setBatchId(select) {
  var obatId = select.value;
  var noBatchSelect = select.closest('.obat-form').querySelector('.no-batch');

  // Buat objek XMLHttpRequest
  var xhr = new XMLHttpRequest();
  
  // Atur callback fungsi untuk menangani kejadian onreadystatechange
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Parsing data JSON yang diterima
      console.log(xhr.responseText);
      var batchList = JSON.parse(xhr.responseText);
      
      // Hapus semua opsi nomor batch yang ada sebelumnya
      noBatchSelect.innerHTML = '';
      
      // Tambahkan opsi nomor batch yang sesuai dengan obat yang dipilih
      batchList.forEach(function (batch) {
        var option = document.createElement('option');
        option.value = batch.id;
        option.text = batch.no_batch;
        noBatchSelect.appendChild(option);
      });
    }
  };
  
  // Kirim permintaan dengan metode GET ke getBatchDataUrl dengan parameter obat_id
  xhr.open('GET', '<?php echo $getBatchDataUrl; ?>?obat_id=' + obatId, true);
  
  // Kirim permintaan
  xhr.send();
}



// Fungsi untuk mengatur nilai id obat yang dipilih
function setSatuanId(select) {
  var satuanId = select.value;
  var inputId = select.closest('.obat-form').querySelector('.satuan-id');
  inputId.value = satuanId;
}

      function hitung() {
        // Mendapatkan input dari elemen input
        var qty_tablet = parseFloat(document.getElementById("qty_tablet").value);
        var harga = parseFloat(document.getElementById("harga").value);
        var total_harga = parseFloat(document.getElementById("total_harga").value);
        var total_bayar = parseFloat(document.getElementById("total_bayar").value);

        // Menghitung perkalian dan pengurangan
        var total_harga = qty_tablet * harga;
        var kembali = total_bayar - total_harga;

        // Menampilkan hasil perkalian dan pengurangan pada elemen input readonly
        document.getElementById("total_harga").value = total_harga;
        document.getElementById("kembali").value = kembali;
      }

      // Memanggil fungsi hitung() setiap kali nilai input berubah
      document.addEventListener("input", hitung);


</script>

<?php
// Fungsi untuk mengenerate nomor struk
function generateNoStruk($conn) {
  // Ambil informasi tanggal saat ini
  $tanggal = date('Ymd');

  // Query untuk mendapatkan jumlah penjualan pada tanggal ini
  $query = "SELECT COUNT(*) as count FROM tb_penjualan WHERE DATE(tgl_penjualan) = CURDATE()";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // Format nomor struk dengan menambahkan angka running
    $no_struk = $tanggal . str_pad(($count + 1), 4, '0', STR_PAD_LEFT);

    return $no_struk;
  } else {
    // Jika terjadi kesalahan dalam query, kembalikan nomor struk default
    return '000000';
  }
}
?>