 
new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      oop: 0,
      nonoop:0,      
    };
  },
  methods: {
  },

  computed: {

      kolom3: function() {
        return this.thousandSeprator(
          this.oop+this.nonoop
          )  
      },
      kolom4: function() {
        return this.thousandSeprator(
          this.oop
          )  
      },

  }

});
