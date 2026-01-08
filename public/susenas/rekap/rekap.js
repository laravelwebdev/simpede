 
new Vue({
  // root node
  el: "#app",
  // the instance state
  data: function() {
    return {
      r1b:0,
      r8b:0,
      r16b:0,
      r52b:0,
      r62b:0,
      r72b:0,
      r98b:0,
      r106b:0,
      r120b:0,
      r125b:0,
      r133b:0,
      r146b:0,

      r1p:0,
      r8p:0,
      r16p:0,
      r52p:0,
      r62p:0,
      r72p:0,
      r98p:0,
      r106p:0,
      r120p:0,
      r125p:0,
      r133p:0,
      r146p:0,

      r431ab:0,
      r431bb:0,
      r431ap:0,
      r431bp:0,

      r189a:0,
      r189b:0,
      r231a:0,
      r231b:0,
      r270:0,
      r279:0,
      r297:0,
      r304:0,

      r5ak5:0,
      r5ak6:0,
      r5ak7:0,
      r5bk5:0,
      r5bk6:0,
      r5ck2:0,
      r5ck3:0,
      r5dk2:0,
      r5dk3:0,
      r5ek2:0,
      r5ek3:0,
      r5ek4:0,
      r5ek5:0,
      r5fk2:0,
      r5fk3:0,
      r5fk4:0,
      r5fk5:0,
      r5gk2:0,
      r5gk3:0,

      rb72k2:0,
      rb72k4:0,
      rb73k2:0,
      rb73k4:0,
      rb74k2:0,
      rb74k4:0,
      rb75k2:0,
      rb75k4:0,

      u1:0,
      t1a1:0,
      t1b1:0,
      t21:0,
      t31:0,
      t41:0,
      t51:0,
      l1:0,

      k2:0,
      u2:0,
      t1a2:0,
      t1b2:0,
      t22:0,
      t32:0,
      t42:0,
      t52:0,
      l2:0,


      k3:0,
      u3:0,
      t1a3:0,
      t1b3:0,
      t23:0,
      t33:0,
      t43:0,
      t53:0,
      l3:0,

    };
  },
  methods: {
    
    jumlahbl(){
      return 1*this.r1b+1*this.r8b+1*this.r16b+1*this.r52b+1*this.r62b+1*this.r72b+1*this.r98b+1*this.r106b+1*this.r120b+1*this.r125b+1*this.r133b+1*this.r146b+1*this.r431ab+1*this.r431bb
    },
    jumlahp(){
      return 1*this.r1p+1*this.r8p+1*this.r16p+1*this.r52p+1*this.r62p+1*this.r72p+1*this.r98p+1*this.r106p+1*this.r120p+1*this.r125p+1*this.r133p+1*this.r146p+1*this.r431ap+1*this.r431bp
    },

    ratamknb(){
      return (30 * this.jumlahbl() /7).toFixed(0)
    },

    ratamknp(){
      return (30 * this.jumlahp() /7).toFixed(0)
    },

    ratamkn(){
      return (30 * (this.jumlahp()+this.jumlahbl()) /7).toFixed(0)
    },

    jumlaha() {
      return 1*this.r189a + 1* this.r231a
    },

    jumlahb() {
      return 1*this.r189b + 1* this.r231b + 1*this.r270+1*this.r279+1*this.r297 + 1* this.r304
    },
    
    ratanon() {
      return (this.jumlaha()+this.jumlahb()/12).toFixed(0)
    },

    sebulan() {
      return 1 * this.ratamkn() + 1 * this.ratanon()
    },

    setahun() {
      return 12 * this.sebulan()
    },

    jumlahu() {
      return (12 * 30 * this.u1 / 7) + (12 * this.u2) + 1* this.u3
    },
    
    jumlahk() {
      return (12 * this.k2) + 1* this.k3
    },

    jumlaht1a() {
      return (12 * 30 * this.t1a1 / 7) + (12 * this.t1a2) + 1* this.t1a3
    },

    jumlaht1b() {
      return (12 * 30 * this.t1b1 / 7) + (12 * this.t1b2) + 1* this.t1b3
    },

    jumlaht2() {
      return (12 * 30 * this.t21 / 7) + (12 * this.t22) + 1* this.t23
    },
    
    jumlaht3() {
      return (12 * 30 * this.t31 / 7) + (12 * this.t32) + 1* this.t33
    },
    jumlaht4() {
      return (12 * 30 * this.t41 / 7) + (12 * this.t42) + 1* this.t43
    },

    jumlaht5() {
      return (12 * 30 * this.t51 / 7) + (12 * this.t52) + 1* this.t53
    },

    jumlahl() {
      return (12 * 30 * this.l1 / 7) + (12 * this.l2) + 1* this.l3
    },

    jumlahb5a() {
      return (1 * this.r5ak5) + (1 * this.r5ak6) + (1 * this.r5ak7)
    },

    jumlahb5b() {
      return (1 * this.r5bk7)
    },
    //blok VI
    b6r1k2() {
      return (1*this.r5ak5+1*this.r5ak6+1*this.r5ak7)
    },
    b6r2k2() {
      return (1*this.r5bk5-1*this.r5bk6)
    },
    b6r3k2() {
      return (1*this.r5ck2-1*this.r5ck3)
    },
    b6r4k2() {
      return (1*this.r5dk2)
    },
    b6r5k2() {
      return (1*this.r5ek2+this.r5ek3)
    },
    b6r6k2() {
      return (1*this.r5fk2+this.r5fk3)
    },
    jlhb6k2() {
      return (1*this.b6r1k2()+1*this.b6r2k2()+1*this.b6r3k2()+1*this.b6r4k2()+1*this.b6r5k2()+1*this.b6r6k2())
    },
    b6r1k4() {
      return (1*this.setahun())
    },
    b6r2k4() {
      return (1*this.r5dk3)
    },
    b6r3k4() {
      return (1*this.r5ek4+this.r5ek5)
    },
    b6r4k4() {
      return (1*this.r5fk4+this.r5fk5)
    },
    b6r5k4() {
      return (1*this.r5gk2-this.r5gk3)
    },
    jlhb6k4() {
      return (1*this.b6r1k4()+1*this.b6r2k4()+1*this.b6r3k4()+1*this.b6r4k4()+1*this.b6r5k4())
    },
    selisihb6() {
      return (1*this. jlhb6k2() -1*this.jlhb6k4())
    },
    //blok VII
    totalmasuk() {
      return (1*this.b6r1k4()+1*this.r5bk6+1*this.r5ck3+1*this.b6r3k4()+1*this.b6r2k4()+1*this.r5gk2+1*this.rb72k4+1*this.rb73k4+1*this.rb74k4+1*this.rb75k4-(1*this.r5ak6+1*this.r5ck2+1*this.r5ek3+1*this.b6r6k2()+1*this.rb74k2))
    },
    totalkeluar() {
      return (1*this.r5ak5+1*this.r5ak7+1*this.r5bk5+1*this.r5ek2+1*this.b6r4k2()+1*this.r5gk3+1*this.rb72k2+1*this.rb73k2+1*this.rb75k2-(1*this.r5fk4+1*this.r5fk5))
    },
    jlhb7k2() {
      return (1*this.totalmasuk()+1*this.rb72k2+1*this.rb73k2+1*this.rb74k2+1*this.rb75k2)
    },
    jlhb7k4() {
      return (1*this.totalkeluar()+1*this.rb72k4+1*this.rb73k4+1*this.rb74k4+1*this.rb75k4)
    },
    selisihb7() {
      return (1*this. jlhb7k4() -1*this.jlhb7k2())
    },
  },

  computed: {

    r4315b: function() {
      return this.thousandSeprator(
         this.jumlahbl()
         )
    },
    r4316b: function() {
      return this.thousandSeprator(
        this.ratamknb())
    },

    r4315p: function() {
      return this.thousandSeprator(
         this.jumlahp()
         )
    },

    r4315: function() {
      return this.thousandSeprator(
         this.jumlahp()+this.jumlahbl()
         )
    },
    r4316p: function() {
      return this.thousandSeprator(
        this.ratamknp())
    },

    r4316: function() {
      return this.thousandSeprator(
        this.ratamkn())
    },

    r437a: function() {
      return this.thousandSeprator(
        this.jumlaha())
    },

    r437b: function() {
      return this.thousandSeprator(
        this.jumlahb())
    },
    r438: function() {
      return this.thousandSeprator(
        this.ratanon())
    },
    r439: function() {
      return this.thousandSeprator(
        this.sebulan())
    },
    total: function() {
      return this.thousandSeprator(
        this.setahun())
    },
    totalmakanan: function() {
      return  this.ratamkn()
    },
    totalnonmakanan: function() {
      return  this.ratanon()
    },


}
 
});
