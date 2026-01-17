 
new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      jenis:"0",
      jumlah:0,         
    };
  },

  methods: {

    m3(jenis,jumlah) {
        var beban = [20000, 25000, 25000, 30000];
        var b1 = [3600, 3600, 3700, 3800];
        var b2 = [5000, 5300, 5500, 5600];
        var b3 = [5000, 5500, 5700, 5800];
        var b4 = [5300, 5700, 6000, 6100];
        var admin = 2500;
        var pajak=0.11;
        var bersih;

        bersih = (this.jumlah - admin)/(1+pajak) - beban[jenis];

        if (bersih < 5*b1[jenis]) {
          return (bersih/b1[jenis]).toFixed(0)
        }
        else if (bersih < (5*b1[jenis]+5*b2[jenis])) {
          return (5 + (bersih-5*b1[jenis])/b2[jenis]).toFixed(0)
        }
        else if (bersih < (5*b1[jenis]+5*b2[jenis]+10*b3[jenis])) {
          return (10 + (bersih - 5*b1[jenis]-5*b2[jenis])/b3[jenis]).toFixed(0)
        }
        else return (20+(bersih - 5*b1[jenis]-5*b2[jenis]-10*b3[jenis])/b4[jenis]).toFixed(0)
    },

  },

  computed: {

      kubik: function() {
        if (this.m3(this.jenis,this.jumlah)>0) {
          return this.m3(this.jenis,this.jumlah)
      } else {
        return 0
      }
    }
  },
    
});
