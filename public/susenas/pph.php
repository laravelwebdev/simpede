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
      <p>Pajak Penghasilan</p>
    </div>
    <fieldset>
      <div>
        <div class="warning">
          <p>PPh untuk ASN/TNI/Polri dan Pegawai tetap BUMN, BUMD, Swasta</p>
        </div>
        <br/>
        <h4>Status</h4>
        <p class="select">
          <select class="budget" v-model="kawin" >
						<option value="k">Kawin</option>
						<option value="b">Belum Kawin</option>
					</select>
        </p>
      </div>
      <div>
        <h4>Jumlah tanggungan</h4>
        <p class="select">
          <select class="budget" v-model="tanggungan" >
						<option value="0">Tanpa Tanggungan</option>
						<option value="1">1 orang</option>
						<option value="2">2 orang</option>            
						<option value="3">>= 3 orang</option>
					</select>
        </p>
      </div>
      <div>
        <label class="label" for="penghasilan">Total Penghasilan selama SETAHUN</label>
        <currency inputmode="numeric" onClick="this.select()"  name="penghasilan" id="penghasilan" required="" v-model="penghasilan" ref="penghasilan"></currency>
      </div>
      <div class="success">
        <p>Perkiraan nilai PPh</p>
      </div>
      <table>
        <tr>
          <td><label class="label-result">Rincian 340:</label></td>
          <td class="right"><label class="label-result">{{ pph }}</label></td>
        </tr>
      </table>

      <div class="warning">
        <p>Jika dibayarkan oleh kantor</p>
      </div>
      <table>
        <tr>
          <td><label class="label-result">Tambahkan Blok VA kolom 6 dengan:</label></td>
          <td class="right"><label class="label-result">{{ pph }}</label></td>
        </tr>
      </table>
     
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="pph.js"></script> 
</body>

</html>