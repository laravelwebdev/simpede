// Regular expression from W3C HTML5.2 input specification:
// https://www.w3.org/TR/html/sec-forms.html#email-state-typeemail

new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      bcg: 0,
      polio:0,
      dpt: 0,
      hb: 0,
      campak: 0,
      tempat:"0",
         
    };
  },
  methods: {
  },
  computed: {

      jumlah: function() {
        return ' Rp. '+this.thousandSeprator(
          this.bcg * 40000 +
          this.polio * 12500 +
          this.dpt * 20000 +
          this.hb * 48000 +
          this.campak * 45000 
          )  
      },

  }

});
