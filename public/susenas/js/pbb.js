// Regular expression from W3C HTML5.2 input specification:
// https://www.w3.org/TR/html/sec-forms.html#email-state-typeemail

new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      jenis:"k",
      kp:"d",
      lahan:0,
      bangunan:0
         
    };
  },

  methods: {
    lhn(kota) {
      if (kota=="d") return this.lahan * 48000 
      if (kota=="k") return this.lahan * 60000
    },
    rmh(dinding) {
      if (dinding=="b") return this.bangunan * 365000
      if (dinding=="k") return this.bangunan * 180000 
    },
    kenapajak(kota,dinding) {
        if ((this.lhn(kota) + this.rmh(dinding))>10000000) {
          return this.lhn(kota) + this.rmh(dinding)-10000000
        } else {
          return 1000000
        }
    }
  },

  computed: {

    pbb: function() {
      return this.thousandSeprator(
        0.001*this.kenapajak(this.kp,this.jenis)
      )
      },
        },  

});
