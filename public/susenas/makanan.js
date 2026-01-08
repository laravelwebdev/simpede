 

new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      harga:0,
      konv:null,
      konvs: window.APP_DATA.konvs,    
    };
  },
  methods: {
    
  },
  computed: {
      q1: function() {
        if (this.konv !=null)
        return (this.harga / this.konv.harga1).toFixed(this.konv.fixed) +' ('+ this.konv.satuan+')';
        else this.harga = 0
      },
      q2: function() {
        if (this.konv !=null)
        return (this.harga / this.konv.harga2).toFixed(this.konv.fixed) +' ('+ this.konv.satuan+')'
      },
      komoditas: function() {
        if (this.konv !=null)
        return this.konv.nama
      },

      jumlah: function() {
        if ((this.konv !=null) && (this.harga!=''))
        return ' Rp. '+this.thousandSeprator(this.harga)  
      },

     


  }

});
