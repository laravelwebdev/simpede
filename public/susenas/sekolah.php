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
      <p>Imputasi Sekolah Gratis</p>
    </div>

    <fieldset>

      <div class="success">
        <p>Isian ini hanya untuk sekolah yang gratis</p>
      </div>
      <br/>
      <div class="warning">
        <p>Semester Berjalan</p>
      </div>
      <br/>
      <div>
        <label class="label" for="sd1">Jumlah yang bersekolah di SD/Sederajat</label>
        <input type="number" onClick="this.select()"  name="sd1" id="sd1" required="" v-model="sd1" ref="sd1" min=0>
      </div>
      <div>
        <label class="label" for="smp1">Jumlah yang bersekolah di SMP/Sederajat</label>
        <input type="number" onClick="this.select()"  name="smp1" id="smp1" required="" v-model="smp1" ref="smp1" min=0>
      </div>
      <div>
        <label class="label" for="sma1">Jumlah yang bersekolah di SMA/Sederajat</label>
        <input type="number" onClick="this.select()"  name="sma1" id="sma1" required="" v-model="sma1" ref="sma1" min=0>
      </div>

      <div class="warning">
        <p>Semester lalu</p>
      </div>
      <br/>
      <div>
        <label class="label" for="sd2">Jumlah yang bersekolah di SD/Sederajat</label>
        <input type="number" onClick="this.select()"  name="sd2" id="sd2" required="" v-model="sd2" ref="sd2" min=0>
      </div>
      <div>
        <label class="label" for="smp2">Jumlah yang bersekolah di SMP/Sederajat</label>
        <input type="number" onClick="this.select()"  name="smp2" id="smp2" required="" v-model="smp2" ref="smp2" min=0>
      </div>
      <div>
        <label class="label" for="sma2">Jumlah yang bersekolah di SMA/Sederajat</label>
        <input type="number" onClick="this.select()"  name="sma2" id="sma2" required="" v-model="sma2" ref="sma2" min=0>
      </div>
            
      <div class="success">
        <p>Perkiraan Pengeluaran sekolah gratis</p>
      </div>
      <table>
        <tr>
          <td><label class="label-result">Tambahkan Rincian 292 dengan: </label></td>
          <td class="right"><label class="label-result">{{ jumlah265 }}</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Tambahkan Rincian 293 dengan: </label></td>
          <td class="right"><label class="label-result">{{ jumlah266 }}</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Tambahkan Rincian 295 dengan: </label></td>
          <td class="right"><label class="label-result">{{ jumlah268 }}</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Jumlah isian yang ditandai T1B</label></td>
          <td class="right"><label class="label-result">{{ jumlah }}</label></td>
        </tr>
      </table>
      
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="sekolah.js"></script> 
</body>

</html>