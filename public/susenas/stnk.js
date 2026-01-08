 
new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      pajak:"1",
      jenis:"0",
      harga:0,

         
    };
  },

  methods: {

    clear() {
      this.harga="0"
    }
  },

  computed: {

      pkb: function() {
        if (this.jenis =="0") return this.thousandSeprator((1.08 * this.harga /100).toFixed(0))
        if (this.jenis =="1") return this.thousandSeprator((1.25 * this.harga /100).toFixed(0))
        },
      swdkllj: function() {
        if (this.jenis =="0" && this.pajak=="1") return this.thousandSeprator(35000)
        if (this.jenis =="1" && this.pajak=="1") return this.thousandSeprator(143000)
        },
      },  
    
    });
