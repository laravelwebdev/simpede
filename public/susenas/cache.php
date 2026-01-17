<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quote cards</title>

<link rel="stylesheet" href="css/quotes.css">
<link rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
      crossorigin="anonymous">

<style>
:root {
    --secondary-color: #741CAF;
}

body {
    margin: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center; /* center vertical */
    align-items: center;     /* center horizontal */
    font-family: "Dancing Script", cursive;
    background: #fff;
}

/* Container membungkus box quotes */
.container {
    position: relative;
    width: 85%;
    max-width: 400px;
    height: 400px;
    overflow: visible; /* shadow box tidak terpotong */
}

/* Inner cards */
.inner {
    position: absolute;
    height: 100%;
    width: 100%;
    opacity: 0;
    transition: 1s;
    visibility: hidden;
}

.box {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 70%;
    transform: translate(-50%, -50%);
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 0 1.5rem rgba(0,0,0,0.3);
    font-size: clamp(1rem, 2vw, 1.3rem);
}

.number::before {
    content: "";
    position: absolute;
    top: -130px;
    right: -30px;
    width: 90px;
    height: 180px;
    background: var(--secondary-color);
    transform: rotate(-45deg);
    z-index: -1;
    box-shadow: 0 0 0.7rem rgba(0,0,0,0.2);
}

.number {
    position: absolute;
    margin: 0;
    top: 15px;
    right: 15px;
    color: rgba(255,255,255,0.7);
}

.quote {
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
}

.credit {
    position: absolute;
    top: 60%;
    right: 5%;
    font-size: 0.8rem;
    font-weight: 500;
}

.credit::before {
    content: "⸛ ";
    vertical-align: middle;
    font-size: 1.4rem;
}

.fas {
    font-size: 3.5rem;
    position: absolute;
    top: 12%;
    left: 7%;
    color: rgba(100,58,122,0.2);
}

.button p {
    background: #802BBC;
    text-align: center;
    color: #fff;
    padding: 1rem 0;
    width: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
    margin: 0;
    transition: 0.2s ease-out;
}

.button p:hover {
    background: var(--secondary-color);
    cursor: pointer;
}

/* Show active card */
#card-one:checked ~ .container .inner-one,
#card-two:checked ~ .container .inner-two,
#card-three:checked ~ .container .inner-three {
    opacity: 1;
    visibility: visible;
}

/* Progress bar wrapper */
.progress-wrapper {
    width: 85%; /* sama dengan container/box */
    max-width: 400px;
    margin-top: 10px; /* jarak dari box */
}

.progress-container {
    width: 100%;
    height: 6px;
    background: #e0e0e0;
    border-radius: 3px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    width: 10%; /* default 10% */
    background: var(--secondary-color);
    transition: width 0.3s ease;
}

.progress-status {
    text-align: center;
    font-size: 0.9rem;
    color: #555;
    margin-top: 6px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container { height: 350px; }
    .box { height: 75%; }
    .fas { font-size: 3rem; }
    .button p { padding: 0.8rem 0; font-size: 0.9rem; }
}

@media (max-width: 480px) {
    .container { height: 300px; }
    .box { height: 80%; }
    .fas { font-size: 2.5rem; }
    .button p { padding: 0.7rem 0; font-size: 0.85rem; }
}
</style>
</head>
<body translate="no">

<!-- RADIO CONTROLLER -->
<input id="card-one" class="hidden" type="radio" name="ok-button" checked>
<input id="card-two" class="hidden" type="radio" name="ok-button">
<input id="card-three" class="hidden" type="radio" name="ok-button">

<div class="container">

    <div class="inner inner-one">
        <div class="box">
            <p class="number">1</p>
            <i class="fas fa-quote-left"></i>
            <p class="quote">
                Develop a passion for learning. If you do, you will never cease to grow.
            </p>
            <p class="credit">Anthony J. D'Angelo</p>
            <label class="button" for="card-two"><p>next</p></label>
        </div>
    </div>

    <div class="inner inner-two">
        <div class="box">
            <p class="number">2</p>
            <i class="fas fa-quote-left"></i>
            <p class="quote">
                An investment in knowledge pays the best interest.
            </p>
            <p class="credit">Benjamin Franklin</p>
            <label class="button" for="card-three"><p>next</p></label>
        </div>
    </div>

    <div class="inner inner-three">
        <div class="box">
            <p class="number">3</p>
            <i class="fas fa-quote-left"></i>
            <p class="quote">
                I have no special talent. I am only passionately curious.
            </p>
            <p class="credit">Albert Einstein</p>
            <label class="button" for="card-one"><p>next</p></label>
        </div>
    </div>

</div>

<!-- Progress bar -->
<div class="progress-wrapper">
    <div class="progress-container">
        <div class="progress-bar" id="bar"></div>
    </div>
    <div class="progress-status" id="text">Progress</div>
</div>
<script>
const bar = document.getElementById('bar');
const text = document.getElementById('text');

function setProgress(p, t){
  bar.style.width = p + '%';
  if(t) text.textContent = t;
}

// =====================
// REGISTER SERVICE WORKER
// =====================
if (!('serviceWorker' in navigator)) {
  setProgress(100,'Browser tidak mendukung offline');
  throw '';
}

setProgress(10,'Mendaftarkan Service Worker…');

navigator.serviceWorker.register('/susenas/sw.js')
.then(() => navigator.serviceWorker.ready)
.then(() => {

  // =========================
  // pastikan controller ada
  // =========================
  function startCaching() {
    setProgress(20,'Mengisi cache…');

    navigator.serviceWorker.controller.postMessage({action:'CACHE_FILES'});

    navigator.serviceWorker.addEventListener('message', e => {
      if (e.data.type==='PROGRESS') {
        const percent = 20 + Math.round((e.data.done / e.data.total) * 70);
        setProgress(percent, `Menyimpan ${e.data.done}/${e.data.total} file…`);
      }
      if (e.data.type==='DONE' || (e.data.done && e.data.done===e.data.total)) {
        setProgress(100,'Cache complete ✔');
        text.classList.add('done');
        setTimeout(()=>{window.location.href='index.php';},500);
      }
    });
  }

  // kalau controller sudah ada, langsung start
  if (navigator.serviceWorker.controller) {
    startCaching();
  } else {
    // tunggu controller siap
    navigator.serviceWorker.addEventListener('controllerchange', () => {
      startCaching();
    });
  }

});
</script>

</body>
</html>
