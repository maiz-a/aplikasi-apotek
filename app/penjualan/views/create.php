<?php
require_once 'app/functions/MY_model.php';
$tb_penjualan = get("SELECT pj.*, u.nama_user
            FROM tb_penjualan pj
            INNER JOIN tb_det_penjualan dpj ON pj.id = dpj.penjualan_id
            INNER JOIN tb_user u ON pj.user_id = u.id
            ");

// Ambil daftar obat dari database
$tb_obat = get("SELECT * FROM tb_obat");
$obat_json = json_encode($tb_obat);

// Ambil daftar user dari database
$tb_user = get("SELECT * FROM tb_user");

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

$total_harga = 0;
$kembali = 0;
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
                          <script>hitung();</script>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Nomor Batch</label>
                        </div>
                        <div class="col-md-6">
                        <select class="form-control no-batch" name="obat[0][no_batch]" onchange="setBatchId(this)" id="no_batch_0" required>
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
                          <input type="number" class="form-control qty-tablet" name="obat[0][qty_tablet]" id="qty_tablet" required>
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
                          <input type="text" class="form-control harga" name="obat[0][harga]" id="harga" required readonly>
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
                        <input type="number" class="form-control" name="total_harga" id="total_harga"  readonly >
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Bayar</label>
                      </div>
                      <div class="col-md-8">
                        <input type="number" class="form-control" name="total_bayar" id="total_bayar"  required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Sisa Kembalian</label>
                      </div>
                      <div class="col-md-8">
                        <input type="number" class="form-control" name="kembali" id="kembali" >
                      </div>
                    </div>
                  </div>

              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>User</label>
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
  return <?php echo $obat_json; ?>;
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

  newObatForm.dataset.index = index; // Tambahkan atribut data-index

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
      setHargaObat(this);
      hitung();
    };
    selects[i].value = ''; // Reset nilai pilihan pada elemen select
  }

  var noBatchSelect = newObatForm.querySelector('.no-batch');
      noBatchSelect.id = 'no_batch_' + index;


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
  hitung(); // Memanggil fungsi hitung() setelah formulir obat dihapus

}

function setObatId(select) {
  var obatId = select.value;
  var inputId = select.closest('.obat-form').querySelector('.obat-id');
  var index = select.closest('.obat-form').dataset.index; // Ambil nilai index
  inputId.value = obatId;

  // Panggil fungsi untuk mengupdate opsi nomor batch
  setBatchId(select);
  setHargaObat(select);
}


function setBatchId(select) {
  var obatId = select.value;
  var noBatchSelect = select.closest('.obat-form').querySelector('.no-batch');
  var index = select.closest('.obat-form').dataset.index; // Ambil nilai index

  // Buat objek XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Atur callback fungsi untuk menangani kejadian onreadystatechange
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Parsing data JSON yang diterima
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

      noBatchSelect.value = ''; // Reset nilai pilihan pada elemen select
    }
  };

  // Kirim permintaan dengan metode GET ke getBatchDataUrl dengan parameter obat_id
  xhr.open('GET', '<?php echo $getBatchDataUrl; ?>?obat_id=' + obatId, true);

  // Kirim permintaan
  xhr.send();
}




function setHargaObat(select) {
  var obatId = select.value;
  var hargaInput = select.closest('.obat-form').querySelector('.harga');

  var obatList = getObatList();
  var selectedObat = obatList.find(function (obat) {
    return obat.id === obatId;
  });

  if (selectedObat) {
    hargaInput.value = selectedObat.harga_jual;
  } else {
    hargaInput.value = '';
  }
}

function setSatuanId(select) {
  var satuanId = select.value;
  var inputId = select.closest('.obat-form').querySelector('.satuan-id');
  var index = select.closest('.obat-form').dataset.index;
  inputId.value = satuanId;
}

</script>


<script>
  
  var total_harga = 0;
  var kembali = 0;

  function hitung() {
    var index = counter - 1;
    var qty = parseInt(document.getElementsByName('obat[' + index + '][qty_tablet]')[0].value);
    var harga = parseInt(document.getElementsByName('obat[' + index + '][harga]')[0].value);
    var total_bayar = parseFloat(document.getElementById("total_bayar").value);

    total_harga = 0; // Reset nilai total harga sebelum menghitung

    // Menghitung total harga untuk setiap obat
    var obatForms = document.getElementsByClassName('obat-form');
    for (var i = 0; i < obatForms.length; i++) {
      var qtyObat = parseInt(document.getElementsByName('obat[' + i + '][qty_tablet]')[0].value);
      var hargaObat = parseInt(document.getElementsByName('obat[' + i + '][harga]')[0].value);
      total_harga += qtyObat * hargaObat;
    }

    var total_bayar = parseFloat(document.getElementById("total_bayar").value);
    kembali = total_bayar - total_harga;
    

    // Menampilkan hasil perkalian dan pengurangan pada elemen input readonly
    document.getElementById("total_harga").value = total_harga;
    document.getElementById("kembali").value = kembali;
  }

  // Memanggil fungsi hitung() setiap kali nilai input berubah
  var obatForms = document.getElementsByClassName('obat-form');
  for (var i = 0; i < obatForms.length; i++) {
    var qtyInput = document.getElementsByName('obat[' + i + '][qty_tablet]')[0];
    qtyInput.addEventListener("change", hitung);
  }
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