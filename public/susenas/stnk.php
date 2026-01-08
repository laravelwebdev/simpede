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
      <p>Imputasi Pajak STNK</p>
    </div>
    <fieldset>
      <div>
        <h4>Jenis Kendaraan</h4>
        <p class="select">
          <select class="budget" v-model="jenis" @change="clear()">
						<option value="0">Sepeda Motor</option>
						<option value="1">Mobil Pribadi</option>
					</select>
        </p>
      </div>
      <div>
        <label class="label" for="harga">Harga Beli Baru</label>
        <currency inputmode="numeric" onClick="this.select()"  name="harga" id="harga" required="" v-model="harga" ref="harga"></currency>
      </div>
      <div>
        <h4>Kondisi Perpajakan</h4>
        <ul class="vue-form-list">
          <li>
            <input type="radio" name="radio-1" id="radio-1" value="0" 
                   v-model="pajak">
            <label for="radio-1">Mati</label>
          </li>
          <li>
            <input type="radio" name="radio-1" id="radio-2" value="1" 
                   v-model="pajak">
            <label for="radio-2">Hidup</label>
          </li>
        </ul>
      </div>
  
      <div class="success">
        <p>Perkiraan Pajak STNK</p>
      </div>
      
      <table>
        <tr>
          <td><label class="label-result">Rincian 336: </label></td>
          <td class="right"><label class="label-result">{{ pkb }}</label></td>
        </tr>
        <tr v-if="pajak==1">
          <td><label class="label-result">Rincian 339: </label></td>
          <td class="right"><label class="label-result">{{ swdkllj }}</label></td>
        </tr>
        <tr v-if="pajak==0">
          <td><label class="label-result">Jumlah yang ditandai K: </label></td>
          <td class="right"><label class="label-result">{{ pkb }}</label></td>
        </tr>
      </table>

      <div class="warning">
        <p>WARNING: perhitungan hanya untuk 1 buah kendaraan</p>
      </div>
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="stnk.js"></script> 
</body>

</html>