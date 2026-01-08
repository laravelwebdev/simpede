 
new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      daya:"0",
      jenis:"0",
      jumlah:0,

         
    };
  },

  methods: {
    kwh(jenis,daya) {
      if (this.jenis==="0") {
        switch(this.daya) {
          case "0":
            return (0.91*this.jumlah/415).toFixed(1)
          case "1":
            return (0.91*this.jumlah/605).toFixed(1)
          case "2":
            return (0.91*this.jumlah/1352).toFixed(1)
          default:
            return (0.91*this.jumlah/1444.7).toFixed(1)
        } 
      } else
      switch(this.daya) {
        case "0":
          if (100*this.jumlah/111-4950 < 5070) {
            return ((100*this.jumlah/111-4950)/169).toFixed(1)
          }
          else if (100*this.jumlah/111-4950 < 15870) {
            return (30+(100*this.jumlah/111-4950-5070)/360).toFixed(1)
          }
          else return (60+(100*this.jumlah/111-4950-15870)/495).toFixed(1)
        case "1":
          if (100*this.jumlah/111-18000 < 5500) {
            return ((100*this.jumlah/111-18000)/275).toFixed(1)
          }
          else if (100*this.jumlah/111-18000 < 23300) {
            return (20+(100*this.jumlah/111-18000-5500)/445).toFixed(1)
          }
          else return (60+(100*this.jumlah/111-18000-23300)/495).toFixed(1)
        case "2":
          return (0.91*this.jumlah/1352).toFixed(1)
        default:
          return (0.91*this.jumlah/1444.7).toFixed(1)
          
      } 
      }
    },  


  computed: {

       jlhkwh: function() {
          if (this.kwh(this.jenis,this.jumlah)>0) {
            return this.kwh(this.jenis,this.jumlah)
        } else {
          return 0
        }
      }
    },
    
    });
