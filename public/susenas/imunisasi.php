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
      <p>Imunisasi</p>
    </div>

    <fieldset>

      <div>
        <h4>Tempat Imunisasi</h4>
        <p class="select">
          <select class="budget" v-model="tempat" >
            <option value="2">Vaksin COVID19</option>
						<option value="0">Puskes/Pustu/Posyandu</option>
						<option value="1">Rumah Sakit/Dokter</option>
					</select>
        </p>
      </div>
      <div v-if="tempat==0" class="success">
        <p>Isian ini hanya untuk setahun terakhir</p>
      </div>
      <div v-if="tempat==0">
        <label class="label" for="bcg">Berapa kali imunisasi BCG</label>
        <input type="number" onClick="this.select()"  name="bcg" id="bcg" required="" v-model="bcg" ref="bcg" min=0>
      </div>
      <div v-if="tempat==0">
        <label class="label" for="polio">Berapa kali imunisasi Polio</label>
        <input type="number" onClick="this.select()"  name="polio" id="polio" required="" v-model="polio" ref="polio" min=0>
      </div>
      <div v-if="tempat==0">
        <label class="label" for="dpt">Berapa kali imunisasi DPT</label>
        <input type="number" onClick="this.select()"  name="dpt" id="dpt" required="" v-model="dpt" ref="dpt" min=0>
      </div>
      <div v-if="tempat==0">
        <label class="label" for="hb">Berapa kali imunisasi HB</label>
        <input type="number" onClick="this.select()"  name="hb" id="hb" required="" v-model="hb" ref="hb" min=0>
      </div>
      <div v-if="tempat==0">
        <label class="label" for="campak">Berapa kali imunisasi Campak</label>
        <input type="number" onClick="this.select()"  name="campak" id="campak" required="" v-model="campak" ref="campak" min=0>
      </div>
      <div class="success">
        <p>Perkiraan nilai imunisasi</p>
      </div>
      <table v-if="tempat==0">
        <tr>
          <td><label class="label-result">Rincian 288: </label></td>
          <td class="right"><label class="label-result">{{ jumlah }}</label></td>
        </tr>
      </table>

      <div v-if="tempat==1" class="warning">
        <p>Imunisasi di Dokter</p>
      </div>
      
      <table v-if="tempat==1">
        <tr>
          <td><label class="label-result">BCG</label></td>
          <td class="right"><label class="label-result">150.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Polio</label></td>
          <td class="right"><label class="label-result">50.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">DPT</label></td>
          <td class="right"><label class="label-result">350.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">HB</label></td>
          <td class="right"><label class="label-result">275.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Campak</label></td>
          <td class="right"><label class="label-result">150.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">MMR</label></td>
          <td class="right"><label class="label-result">170.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Combo</label></td>
          <td class="right"><label class="label-result">475.000/kali</label></td>
        </tr>

      </table>

      <div v-if="tempat==1" class="warning">
        <p>Imunisasi di Rumah Sakit</p>
      </div>
      
      <table v-if="tempat==1">
        <tr>
          <td><label class="label-result">BCG</label></td>
          <td class="right"><label class="label-result">112.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Polio</label></td>
          <td class="right"><label class="label-result">15.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">DPT</label></td>
          <td class="right"><label class="label-result">308.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">HB</label></td>
          <td class="right"><label class="label-result">227.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Campak</label></td>
          <td class="right"><label class="label-result">60.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">MMR</label></td>
          <td class="right"><label class="label-result">96.000/kali</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Combo</label></td>
          <td class="right"><label class="label-result">285.000/kali</label></td>
        </tr>

        <div v-if="tempat==2" class="warning">
          <p>Vaksin COVID-19 Tidak perlu diperkirakan/imputasi</p>
        </div>
        
        <!-- <table v-if="tempat==2">
          <tr>
            <td><label class="label-result">Astra Zeneca</label></td>
            <td class="right"><label class="label-result">110.000 /dosis/orang</label></td>
          </tr>
          <tr>
            <td><label class="label-result">Sinovac</label></td>
            <td class="right"><label class="label-result">240.000 /dosis/orang</label></td>
          </tr>
          <tr>
            <td><label class="label-result">Moderna</label></td>
            <td class="right"><label class="label-result">505.000 /dosis/orang</label></td>
          </tr>
          <tr>
            <td><label class="label-result">Pfizer</label></td>
            <td class="right"><label class="label-result">350.000 /dosis/orang</label></td>
          </tr>
          <tr>
            <td><label class="label-result">Sinopharm</label></td>
            <td class="right"><label class="label-result">880.000 /dosis/orang</label></td>
          </tr>
    
      </table> -->
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="imunisasi.js"></script> 
</body>

</html>