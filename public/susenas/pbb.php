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
      <p>Pajak Bumi dan Bangunan</p>
    </div>

    <fieldset>

      <div>
        <h4>Jenis Bangunan</h4>
        <p class="select">
          <select class="budget" v-model="jenis" >
						<option value="k">Kayu</option>
						<option value="b">Beton</option>
					</select>
        </p>
      </div>
      <div>
        <h4>Daerah</h4>
        <p class="select">
          <select class="budget" v-model="kp" >
						<option value="d">Perdesaan</option>
						<option value="k">Perkotaan</option>
					</select>
        </p>
      </div>
      <div>
        <label class="label" for="lahan">Luas Total Lahan (m2)</label>
        <input type="number" onClick="this.select()"  name="lahan" id="lahan" required="" v-model="lahan" ref="lahan" min=0>
      </div>
      <div>
        <label class="label" for="bangunan">Luas Total Bangunan (m2)</label>
        <input type="number" onClick="this.select()"  name="bangunan" id="bangunan" required="" v-model="bangunan" ref="bangunan" min=0>
      </div>
      <div class="success">
        <p>Perkiraan nilai PBB</p>
      </div>
      <table>
        <tr>
          <td><label class="label-result">Rincian 335:</label></td>
          <td class="right"><label class="label-result">{{ pbb }}</label></td>
        </tr>
      </table>
     
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="pbb.js"></script> 
</body>

</html>