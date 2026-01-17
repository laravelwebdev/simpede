<!DOCTYPE html>
<html lang='en' class=''>

<head>
  <meta charset='UTF-8'>
  <title>iSusenas</title>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">  
</head>

<body>
  <div id="app">
  <form class="vue-form" @submit.prevent="submit">
    <div class="error-message">
      <p>Biaya Kesehatan</p>
    </div>

    <fieldset>

      <div>
        <h4>Jenis Biaya</h4>
        <p class="select">
          <select class="budget" v-model="jenis" >
						<option value="Rawat Jalan">Rawat Jalan</option>
						<option value="Rawat Inap">Rawat Inap</option>
            <option value="Persalinan dan KB">Persalinan dan KB</option>
            <option value="Transfusi Darah">Transfusi Darah</option>
            <option value="Tes Kesehatan">Tes Kesehatan</option>
            <option value="Layanan UGD">Layanan UGD</option>
					</select>
        </p>
      </div>
      <div class="success">
        <p>Perkiraan nilai {{ jenis }}</p>
      </div>
      <table v-if="jenis=='Rawat Jalan'">
        <tr>
          <td><label class="label-result">Puskesmas/sejenis </label></td>
          <td class="right"><label class="label-result">30.000 - 60.000</label></td>
        </tr>
        <tr>
          <td><label class="label-result">RS/Klinik/Praktek Dokter</label></td>
          <td class="right"><label class="label-result">80.000 - 100.000</label></td>
        </tr>
      </table>


      <table v-if="jenis=='Rawat Inap'">
        <tr>
          <td><label class="label-result">Rawat Inap ditanggung BPJS </label></td>
          <td class="right"><label class="label-result">maksimal 100.000/hari</label></td>
        </tr>
      </table>
      <div v-if="jenis=='Rawat Inap'" class="success">
        <p>Tarif rawat Inap RSUD Damanhuri</p>
      </div>
      <table v-if="jenis=='Rawat Inap'">
        <tr>
          <td><label class="label-result">Super VIP </label></td>
          <td class="right"><label class="label-result">520.000/hari</label></td>
        </tr>
        <tr>
          <td><label class="label-result">VIP 1</label></td>
          <td class="right"><label class="label-result">476.000/hari</label></td>
        </tr>
        <tr>
          <td><label class="label-result">VIP 2</label></td>
          <td class="right"><label class="label-result">430.000/hari</label></td>
        </tr>
        <tr>
          <td><label class="label-result">ICU/NICU/PICU</label></td>
          <td class="right"><label class="label-result">350.000/hari</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Kelas I</label></td>
          <td class="right"><label class="label-result">300.000/hari</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Kelas II</label></td>
          <td class="right"><label class="label-result">190.000/hari</label></td>
        </tr>
        <!-- <tr>
          <td><label class="label-result">Isolasi</label></td>
          <td class="right"><label class="label-result">65.000/hari</label></td>
        </tr> -->
        <tr>
          <td><label class="label-result">Kelas III</label></td>
          <td class="right"><label class="label-result">150.000/hari</label></td>
        </tr>
      </table>

      <div v-if="jenis=='Rawat Inap'" class="warning">
        <p>Belum termasuk biaya obat</p>
      </div>

      <table v-if="jenis=='Persalinan dan KB'">
        <tr>
          <td><label class="label-result">KB Implan/IUD</label></td>
          <td class="right"><label class="label-result">100.000</label></td>
        </tr>
        <tr>
          <td><label class="label-result">KB Suntik</label></td>
          <td class="right"><label class="label-result">15.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">*Pil KB</label></td>
          <td class="right"><label class="label-result">12.000/keping</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Pemeriksaan Kehamilan</label></td>
          <td class="right"><label class="label-result">25.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Persalinan Normal</label></td>
          <td class="right"><label class="label-result">600.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Persalinan dengan tindakan emergency dasar</label></td>
          <td class="right"><label class="label-result">750.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Penanganan perdarahan paska keguguran</label></td>
          <td class="right"><label class="label-result">750.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Pelayanan Tindakan Pasca Melahirkan</label></td>
          <td class="right"><label class="label-result">175.000/kali</label></td>
        </tr>
      </table>

      <table v-if="jenis=='Transfusi Darah'">
        <tr>
          <td><label class="label-result">Transfusi darah </label></td>
          <td class="right"><label class="label-result">360.000/kantong</label></td>
        </tr>
      </table>

      <table v-if="jenis=='Tes Kesehatan'">
        <tr>
          <td><label class="label-result">Pemeriksaan Gula Darah</label></td>
          <td class="right"><label class="label-result">10.000 - 20.000</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Pemeriksaan IVA</label></td>
          <td class="right"><label class="label-result">25.000</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Pap Smear</label></td>
          <td class="right"><label class="label-result">125.000</label></td>
        </tr>
        <tr>
          <td><label class="label-result">*KIR</label></td>
          <td class="right"><label class="label-result">50.000 - 275.000</label></td>
        </tr>
      </table>


      <table v-if="jenis=='Layanan UGD'">
        <tr>
          <td><label class="label-result">Layanan UGD</label></td>
          <td class="right"><label class="label-result">100.000 - 150.000</label></td>
        </tr>
      </table>
      <div v-if="jenis=='Layanan UGD'" class="warning">
        <p>Belum termasuk biaya obat</p>
      </div>
    </fieldset>
  </form>

</div>
  
<script src="js/vue.min.js"></script>
<script src="js/kesehatan.js"></script> 
</body>

</html>