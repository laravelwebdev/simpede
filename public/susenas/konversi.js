// Regular expression from W3C HTML5.2 input specification:
// https://www.w3.org/TR/html/sec-forms.html#email-state-typeemail

new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      komoditas:"0",
      indexsat:"0",
      jumlah:0,
      konversi: [
        //beras
      {
        satuan: ['Liter', 'Mug Susu', 'Cup/takaran Rice Cooker'],
        konv:[0.89, 0.297, 0.15],
        sat: 'Kg'
      },
              //gula
      {
        satuan: ['Kg'],
        konv:[16],
        sat: 'Butir'
      },
                    //jagung
      {
        satuan: ['Kg'],
        konv:[1.45],
        sat: 'Kg jagung basah dengan kulit'
      },
                          //kacang tanah
      {
        satuan: ['Kg'],
        konv:[0.4],
        sat: 'Kg kacang tanah tanpa kulit'
      },
                          //kedelai
      {
        satuan: ['Kg'],
        konv:[0.18],
        sat: 'Kg Kacang Kedelai'
      },
                          //jagung
      {
        satuan: ['Seperapat Kilo', 'Setengah Kilo', 'Kg'],
        konv:[2.5, 5, 10],
        sat: 'Ons'
      },
      {
        satuan: ['Bungkus'],
        konv:[1.0],
        sat: 'x 10 atau 12 atau 16 Batang'
      },
    ]
      };
  },


  computed: {

    total: function() {
      return (this.jumlah* this.konversi[this.komoditas].konv[this.indexsat]).toFixed(2)
    },
    std: function() {
      return this.konversi[this.komoditas].sat
    },

}
 
});
