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
  <button onclick="topFunction()" id="myBtn" title="Go to top"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAA7AAAAOwBeShxvQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANtSURBVFiFxZdNaFxVFMd/5853O8l0+mEjqDRCF9UsojEpGtA2BaFpQQwiguDChW5URNBCFaNQNIG2pC1uXZWYhUkK0gYVumoiMQuxtKtKClmIE2snHzOZj5f7jovMTEwymXkTMvG/eo973v393/0491zBo/Z3aoN1M6dROa7QKnAI2FNonlO4L/A7qjd9/sj1B+Oy6KVfqQpuSz9qA+Zz4C1gl0e/SwqDrkj/wi/hP7Zm4KSG9s5lP1XlI2C3R/B6OSAXk/FQL2OS82zgQHuqadn4RhCe3yJ4vSYCantmJ6OJqgbiL+RacN0bwOPbBC9qBmNOJSdCdzY18MjR1EFHfFN1gJdMBNR2/HckTPHh0DENO/hG6wgHeMIR3zAnNbTBwEIue3Yb57ySOuMPs73FF4HSVrvH1ld7rcq7Vo7MT4WnDUBhn+8UHCBo/HoGQPZ3aoO12b/wnmS2S2l/ONxkrJs5vRV4LApX+4MMnQ+yN1Y1oZbTbpvNdBtUjtf6ZWMUhi8F6X7R8HKn4dqVIPv21G5CVbqMQmut8JFLQZ59qrSBaDksjF7eggmh1Qg0e42PRWH08ip8aMxy9Qe7xkQt0yHQ7AcavQQ3RuH7gSDPHFmBj/xsef+cg6uQd+DtHh8th4VrV4K8+kGef+a0ap8KMVM1qgAfHgjS9vQq/N0vHKwLqvDxeYdvR9aOhNfpMMBCpYBdkZVhL8KHxizvFOClP1H45IKzYToao5XhAvNGYbpS0EvPmdKwD41Z3jvn4Lob41wXPuxba+KVLl9FAwrTvshjn3UAbZsF/fm3cnCf8NO4y9mB5bLwUocKP467+P2QzsA3g5bUUkUH1yV+dOkNRL6raLVOEtHX/89UnAouhZvMg3FZVBjcYTgIg4nbkjYArkg/4OwgPuda+qBQkKyUznKxrsi1eenC/K+R+yUDAMl4qBeYqJuB1bx0K7kY/rL4spoJxyQXUNsDzNTNxEpR+hp3Jb/RADA7GU1gzKk6mZgRa7rX3w02nAXJidCdgNoOYHwb4bccs9z+cCp0d31D2cNodjKaSMbDJ1C+BvLlYjwqD3yVXAyfSE00zJYLqHpkxdqzTxq/nkF5E++Fawph0LX0FVf7ZvJcPRw4plGbzXSrShdCq0CzFq7nUrieA7+J6M1AOnIjcVvSXvr9FwBNRpF7gDohAAAAAElFTkSuQmCC"/></button>
  <div id="app">
  <form class="vue-form" @submit.prevent="submit">
    <div class="error-message">
      <p>Konsistensi K dan KP</p>
    </div>

    <fieldset>

      <div>
      <div class="blue-message">
        <p>VSEN22.K</p>
      </div>
      <br><br>
      <table>
        <tr v-for="entry in entries">
          <td colspan="6"><label class="label-result">{{ entry.label }}</label></td>
          <td>
            <div>
              <input :id="entry.value" type="checkbox" name="rinciank" :value="entry.value" v-model="rinciank" />
              <label class="label-result" :for="entry.value"></label>
            </div>
          </td>
        </tr>
      </table>
      <div class="blue-message">
        <p>VSEN22.KP</p>
      </div>
      <br><br>
      <table>
        <tr>
          <td colspan="2" class="error label-result">Jika error, pernyataan harus terpenuhi</td>
          <td colspan="2" class="warning label-result">Jika warning, beri catatan jika tidak terpenuhi</td>
        </tr>
        <tr v-for="kp in rinciankp">
          <td colspan="2"><label class="label-result">{{ kp.rincian }}</label></td>
          <td><label class="label-result">{{ kp.kondisi }}</label></td>
          <td v-if="kp.fatal==2" class="warning">Warning</td>
          <td v-if="kp.fatal==1" class="error">Error</td>
        </tr>
      </table>
    </fieldset>
  </form>

</div>
<script>
  var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<script src="js/vue.min.js"></script>
<script src="js/konsistensi.js"></script> 
</body>

</html>