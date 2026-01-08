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
      <p>Bantu Hitung OOP</p>
    </div>

    <fieldset>

      <div>
        <label class="label" for="oop">Biaya Yang Dikeluarkan sendiri</label>
        <currency inputmode="numeric" onClick="this.select()"  name="oop" id="oop" required="" v-model="oop" ref="oop"></currency>
      </div>
      <div>
        <label class="label" for="nonoop">Biaya Yang Ditanggung Pihak Lain</label>
        <currency inputmode="numeric" onClick="this.select()"  name="nonoop" id="nonoop" required="" v-model="nonoop" ref="nonoop"></currency>
      </div>


      <table>
        <tr>
          <td><label class="label-result">Rincian Kolom 3 (Total): </label></td>
          <td class="right"><label class="label-result">{{ kolom3 }}</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Rincian Kolom 4 (OOP) </label></td>
          <td class="right"><label class="label-result">{{ kolom4 }}</label></td>
        </tr>
        <tr>
          <td><label class="label-result">Tambahkan Rincian 504 di kolom 3 atau 4 dengan:</label></td>
          <td class="right"><label class="label-result">{{ thousandSeprator(nonoop) }}</label></td>
        </tr>
      </table>
      
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="oop.js"></script> 
</body>

</html>