<!DOCTYPE html>
<html lang='en' class=''>

<head>
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
      <p>Bantu Hitung Rincian 502</p>
    </div>

    <fieldset>

      <div>
        <label class="label" for="gaji">Biaya untuk Gaji Karyawan/Buruh/Pegawai</label>
        <currency inputmode="numeric" onClick="this.select()"  name="gaji" id="gaji" required="" v-model="gaji" ref="gaji"></currency>
      </div>
      <div>
        <label class="label" for="nongaji">Biaya Produksi Selain Gaji Karyawan/Buruh/Pegawai</label>
        <currency inputmode="numeric" onClick="this.select()"  name="nongaji" id="nongaji" required="" v-model="nongaji" ref="nongaji"></currency>
      </div>


      <table>
        <tr>
          <td><label class="label-result">Rincian 502 kolom 6: </label></td>
          <td class="right"><label class="label-result">{{ kolom6 }}</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Rincian 502 kolom 7: </label></td>
          <td class="right"><label class="label-result">{{ kolom7}}</label></td>
        </tr>
      </table>
      
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="r502.js"></script> 
</body>

</html>