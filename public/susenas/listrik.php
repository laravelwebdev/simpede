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
      <p>Listrik PLN</p>
    </div>
    <fieldset>
      <div>
        <h4>Jenis</h4>
        <ul class="vue-form-list">
          <li>
            <input type="radio" name="radio-1" id="radio-1" value="0" 
                   v-model="jenis">
            <label for="radio-1">Prabayar (Pulsa)</label>
          </li>
          <li>
            <input type="radio" name="radio-1" id="radio-2" value="1" 
                   v-model="jenis">
            <label for="radio-2">Reguler</label>
          </li>
        </ul>
      </div>
      <div>
        <h4>Daya</h4>
        <p class="select">
          <select class="budget" v-model="daya">
						<option value="0">450 VA</option>
						<option value="1">900 VA Subsidi</option>
            <option value="2">900 VA R1M</option>
            <option value="3">>=1300 VA</option>
					</select>
        </p>
      </div>
      <div>
        <label class="label" for="jumlah">Pemakaian (Rupiah)</label>
        <currency inputmode="numeric" onClick="this.select()"  name="jumlah" id="jumlah" required="" v-model="jumlah" ref="jumlah"></currency>
      </div>
      <div class="success">
        <p>Perkiraan KWh</p>
      </div>
      
      <table>
        <tr>
          <td><label class="label-result">Rincian 233:</label></td>
          <td class="right"><label class="label-result">{{ jlhkwh }} KWh</label></td>
        </tr>
      </table>
    </fieldset>
  </form>

</div>
  
<script src="vue.min.js"></script>
<script src="currency.js"></script>
<script src="listrik.js"></script> 
</body>

</html>