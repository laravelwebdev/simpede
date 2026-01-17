<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote cards</title>
<style>
@charset "UTF-8";
@import url("https://fonts.googleapis.com/css?family=Dancing+Script|Josefin+Sans:600");
:root {
    --secondary-color: #741CAF;
    --sans: "josefin sans", sans serif;
}

body {
    background: #ffffff;
    margin: 0;
    padding: 10px;
}

.container {
    position: relative;
    width: 100%;
    max-width: 400px;
    height: 400px;
    margin: 50px auto;
    background: var(--main-color);
    border-radius: 5px;
    font-family: "dancing script", cursive;
    overflow: hidden;
    color: #797d7f;
    letter-spacing: 0.5px;
}

.hidden {
    display: none;
}

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
    width: 85%;
    height: 70%;
    transform: translate(-50%, -50%);
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 0 1.5rem rgba(0, 0, 0, 0.5);
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
    box-shadow: 0 0 0.7rem rgba(0, 0, 0, 0.5);
}

.number {
    font-family: var(--sans);
    position: absolute;
    margin: 0;
    top: 15px;
    right: 15px;
    color: rgba(255, 255, 255, 0.7);
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
    font-family: var(--sans);
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
    color: rgba(100, 58, 122, 0.2);
}

input {
    width: 100%;
    transition: 0.3s;
}

.button p {
    background: #802BBC;
    text-align: center;
    color: #fff;
    padding: 1rem 0;
    width: 100%;
    font-family: var(--sans);
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

#card-one:checked ~ .container .inner-one,
#card-two:checked ~ .container .inner-two,
#card-three:checked ~ .container .inner-three {
    opacity: 1;
    visibility: visible;
}

#card-one:checked ~ .container .inner-two,
#card-two:checked ~ .container .inner-three,
#card-three:checked ~ .container .inner-one {
    transform: scale(0.85);
    transform: scale(1) translate(-20rem);
}

@media (max-width: 768px) {
    .container {
        height: 350px;
        margin: 30px auto;
    }
    
    .box {
        width: 90%;
        height: 75%;
    }
}

@media (max-width: 480px) {
    .container {
        height: 300px;
        margin: 20px auto;
    }
    
    .box {
        width: 90%;
        height: 80%;
    }
    
    .fas {
        font-size: 2.5rem;
    }
    
    .button p {
        padding: 0.8rem 0;
        font-size: 0.9rem;
    }
}
</style> 
</head>

<body translate="no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<input id="card-one" class="hidden" type="radio" name="ok-button" checked>
    <input id="card-two" class="hidden" type="radio" name="ok-button">
    <input id="card-three" class="hidden" type="radio" name="ok-button">

<div class="container">
    
    <div class="inner inner-one">
        <div class="box">
            <p class="number">1</p>
            <div class="text">
                <i class="start-quote fas fa-quote-left"></i>
                <p class="quote">Develop a passion for learning. If you do, you will never cease to grow.</p>
                <p class="credit">Anthony J. D'Angelo</p>
            </div>
            <label class="button" for="card-two">
                <p>next</p>
            </label>
        </div>
    </div>
    
    <div class="inner inner-two">
        <div class="box">
            <p class="number">2</p>
            <i class="start-quote fas fa-quote-left"></i>
            <p class="quote">An investment in knowledge pays the best interest.</p>
            <p class="credit">Benjamin Franklin</p>
            <label class="button" for="card-three">
                <p>next</p>
            </label>
        </div>
    </div>
    
    <div class="inner inner-three">
        <div class="box">
            <p class="number">3</p>
            <i class="start-quote fas fa-quote-left"></i>
            <p class="quote">I have no special talent. I am only passionately curious.</p>
            <p class="credit">Albert Einstein</p>
            <label class="button" for="card-one">
                <p>next</p>
            </label>
        </div>
    </div>
</div>  
</body>
</html>
