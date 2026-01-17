// Regular expression from W3C HTML5.2 input specification:
// https://www.w3.org/TR/html/sec-forms.html#email-state-typeemail

new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      sd1: 0,
      smp1:0,
      sma1: 0,
      sd2: 0,
      smp2:0,
      sma2: 0,         
    };
  },
  methods: {
    r265(){
      return (100000 * this.sd1 + 0 * this.sd2) +
      (100000 * this.smp1 + 0 * this.smp2) +
      (100000 * this.sma1 + 0 * this.sma2) 
    }
  },

  computed: {

      jumlah265: function() {
        return ' Rp. '+this.thousandSeprator(
          this.r265()
          )  
      },
      jumlah266: function() {
        return ' Rp. '+this.thousandSeprator(
          (200000 * this.sd1 + 200000 * this.sd2) +
          (300000 * this.smp1 + 300000 * this.smp2) +
          (400000 * this.sma1 + 400000 * this.sma2) - this.r265()
          )  
      },
      jumlah268: function() {
        return ' Rp. '+this.thousandSeprator(
          (25000 * this.sd1 + 25000 * this.sd2) +
          (75000 * this.smp1 + 75000 * this.smp2) +
          (100000 * this.sma1 + 100000 * this.sma2) 
          )  
      },
      jumlah: function() {
        return ' Rp. '+this.thousandSeprator(
          (225000 * this.sd1 + 225000* this.sd2) +
          (375000* this.smp1 + 375000 * this.smp2) +
          (500000 * this.sma1 + 500000 * this.sma2) 
        )
      }

  }

});
