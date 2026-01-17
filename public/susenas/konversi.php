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
      <p>Konversi Satuan</p>
    </div>

    <fieldset>

      <div>
        <h4>Jenis Komoditas</h4>
        <p class="select">
          <select class="budget" v-model="komoditas" >
						<option value="0">Beras</option>
						<option value="1">Telur Ayam Ras</option>
            <option value="2">Jagung basah tanpa kulit</option>
						<option value="3">Kacang Tanah dengan kulit</option>
            <option value="4">Kacang Kedelai dengan batang</option>
						<option value="5">Gula Pasir/merah</option>
						<option value="6">Rokok</option>
					</select>
        </p>    


          <div><input type="number" onClick="this.select()"  name="jumlah" id="jumlah" required="" v-model="jumlah" ref="jumlah" min=0></div>
          <div> 
              <select v-model="indexsat">
                <option v-for="(item, key) in konversi[komoditas].satuan" :value="key">
                  {{item}}
                </option>
              </select>
          </div>

      
 

      <div class="success">
        <p>Perkiraan Kuantitas</p>
      </div>
      <table>
        <tr>
          <td class="right"><label class="label-result">{{ total }}</label></td>
          <td><label class="label-result">{{std}}</label></td>
        </tr>
      </table>
    </fieldset>
  </form>

</div>
  
<script src="js/vue.min.js"></script>
<script src="js/konversi.js"></script> 
</body>

</html>