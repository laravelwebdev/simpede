<!DOCTYPE html>
<html lang='en' class=''>

<head>
  <meta charset='UTF-8'>
  <title>iSusenas</title>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="style.css">  
</head>

<body>
  <div id="app">
  <form class="vue-form" @submit.prevent="submit">
    <div class="error-message">
      <p>Iuran BPJS</p>
    </div>

    <fieldset>

      <div>
        <h4>Jenis Kepesertaan</h4>
        <p class="select">
          <select class="budget" v-model="jenis" @change="clear()">
						<option value="0">PBI dan Mandiri</option>
						<option value="1">Penerima Upah (Karyawan/pegawai)</option>
					</select>
        </p>
      </div>
      <div v-if="jenis=='0'">
        <label class="label" for="pbi">Jumlah Peserta PBI</label>
        <input type="number" onClick="this.select()"  name="pbi" id="pbi" required="" v-model="pbi" ref="pbi" min=0>
      </div>
      <div v-if="jenis=='0'">
        <label class="label" for="k3">Jumlah Peserta Kelas III</label>
        <input type="number" onClick="this.select()"  name="k3" id="k3" required="" v-model="k3" ref="k3" min=0>
      </div>
      <div v-if="jenis=='0'">
        <label class="label" for="k2">Jumlah Peserta Kelas II</label>
        <input type="number" onClick="this.select()"  name="k2" id="k2" required="" v-model="k2" ref="k2" min=0>
      </div>
      <div v-if="jenis=='0'">
        <label class="label" for="k1">Jumlah Peserta Kelas I</label>
        <input type="number" onClick="this.select()"  name="k1" id="k1" required="" v-model="k1" ref="k1" min=0>
      </div>

      <div v-if="jenis=='1'">
        <label class="label" for="upah">Upah/gaji pokok per bulan</label>
        <currency inputmode="numeric" v-model="upah" name="upah" id="upah" required="" ref="upah" onClick="this.select()" ></currency>
      </div>

      <div class="success">
        <p>Kepesertaan 1 tahun atau lebih</p>
      </div>
      
      <table>
        <tr>
          <td><label class="label-result">Rincian 338: </label></td>
          <td class="right"><label class="label-result">{{ jumlah }}</label></td>
        </tr>
        <tr v-if="jenis=='0'">
          <td><label class="label-result">Jumlah yang ditandai T1B: </label></td>
          <td class="right"><label class="label-result">{{ transfer }}</label></td>
        </tr>
        <tr v-if="jenis=='1'">
          <td><label class="label-result">Tambahkan Blok VA kolom 6 dengan: </label></td>
          <td class="right"><label class="label-result">{{ gaji }}</label></td>
        </tr>
      </table>

      <div class="success">
        <p>Kepesertaan kurang dari 1 tahun</p>
      </div>
      
      <table>
        <div v-if="jenis=='0'" class="warning">
          <p>Rincian 338:</p>
        </div>
             <tr v-if="jenis=='0'">
          <td><label class="label-result">PBI</label></td>
          <td class="right"><label class="label-result">42.000/orang/bulan</label></td>
        </tr>
         <tr v-if="jenis=='0'">
          <td><label class="label-result">Kelas III</label></td>
          <td class="right"><label class="label-result">42.000/orang/bulan</label></td>
        </tr>
               <tr v-if="jenis=='0'">
          <td><label class="label-result">Kelas II</label></td>
          <td class="right"><label class="label-result">100.000/orang/bulan</label></td>
        </tr>
        <tr v-if="jenis=='0'">
          <td><label class="label-result">Kelas I</label></td>
          <td class="right"><label class="label-result">150.000/orang/bulan</label></td>
        </tr>
        <tr v-if="jenis=='1'">
          <td><label class="label-result">Rincian 338: </label></td>
          <td class="right"><label class="label-result">5% dari Gaji Pokok/bulan</label></td>
        </tr>
        <tr v-if="jenis=='0'">
          <td colspan="2"><div  class="warning"><p>Jumlah yang diberi tanda T1B:</p></div></td>
        </tr>
        <tr v-if="jenis=='0'">
          <td><label class="label-result">PBI: </label></td>
          <td class="right"><label class="label-result">Seluruh Total Iuran</label></td>
        </tr>
        <tr v-if="jenis=='0'">
          <td><label class="label-result">Kelas III</label></td>
          <td class="right"><label class="label-result">7.000/orang/bulan</label></td>
        </tr>
        <tr v-if="jenis=='1'">
          <td colspan="2"><div  class="warning"><p>Blok VA kolom 6:</p></div></td>
        </tr>
        <tr v-if="jenis=='1'">
          <td><label class="label-result">Tambahkan Blok VA kolom 6 dengan: </label></td>
          <td class="right"><label class="label-result">4% dari Gaji Pokok/bulan</label></td>
        </tr>
      </table>
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="bpjs.js"></script> 
</body>

</html>