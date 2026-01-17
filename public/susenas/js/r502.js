 
new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      gaji: 0,
      nongaji:0,    
    };
  },
  methods: {
  },

  computed: {

      kolom6: function() {
        return this.thousandSeprator(
          this.gaji+this.nongaji
          )  
      },
      kolom7: function() {
        if (1*this.gaji+1*this.nongaji==0) {
          return 0
      } else
        return this.thousandSeprator(
          (100*this.gaji/(this.gaji+this.nongaji)).toFixed(0)
          )  
      },

  }

});
