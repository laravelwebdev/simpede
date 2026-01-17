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
      <p>PDAM</p>
    </div>
    <fieldset>
      <div>
        <h4>Golongan</h4>
        <p class="select">
          <select class="budget" v-model="jenis">
						<option value="0">Rumah Sangat Sederhana</option>
						<option value="1">Rumah Sederhana</option>
            <option value="2">Rumah Mewah/menengah</option>
            <option value="3">Rumah Mewah Bertingkat</option>
					</select>
        </p>
      </div>
      <div>
        <label class="label" for="jumlah">Pemakaian (Rupiah)</label>
        <currency inputmode="numeric" onClick="this.select()"  name="jumlah" id="jumlah" required="" v-model="jumlah" ref="jumlah"></currency>
      </div>
      <div class="success">
        <p>Perkiraan Pemakaian</p>
      </div>
      
      <table>
        <tr>
          <td><label class="label-result">Rincian 235: </label></td>
          <td class="right"><label class="label-result">{{ kubik }} m3</label></td>
        </tr>
      </table>
    </fieldset>
  </form>

</div>
  
<script src="js/vue.min.js"></script>
<script src="js/currency.js"></script>
<script src="js/pdam.js"></script> 
</body>

</html>