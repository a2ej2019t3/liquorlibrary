<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Cinzel:700|Lato|Montserrat|Open+Sans|Roboto|Shadows+Into+Light|Playfair+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700&subset=latin-ext" rel="stylesheet">
    <style>
        svg {
            margin-left: -10px;
            margin-top:45vh;
            width: 100vw;
            height: 100vh;
        }

        path {
            stroke: #fded81;
            stroke-width: 80vh;
            stroke-linecap: round;
            fill: none;
        }

        #front {
            color: rgba(255, 255, 255, 0.5);
            top: 50%;
            left: 0;
            position: fixed;
            width: 100vw;
            height: 100vh;
            padding-top: 0px;
            margin-top: -5rem;
            text-align: center;
            font-size: 6rem;
            z-index: 100;
        }

        #back {
            z-index: -100;
            color: rgba(0, 0, 0, 0.9);
            top: 50%;
            left: 0;
            position: fixed;
            width: 100vw;
            height: 100vh;
            padding-top: 0px;
            margin-top: -5rem;
            text-align: center;
            font-size: 6rem;
        }

        body {
            overflow-y: hidden;
        }
    </style>
</head>

<body>
    <svg>
        <path d="M10,10 L50,100 L90,50"></path>
    </svg>
    <p id="front" style="font-family: 'Cinzel', serif;">Liquor Library</p>
    <p id="back" style="font-family: 'Cinzel', serif;">Liquor Library</p>
    <script>
        let xs = [];
        for (var i = 0; i <= 2000; i++) {
            xs.push(i);
        }

        let t = 0;

        function animate () {
            let points = xs.map(x => {
                let y = 400 + 20 * Math.sin((x + t) / 300);
                return [x,y];
            })

            let path = "M" + points.map(p =>{
                return p[0] + "," + p[1]
            }).join("L")

            console.log(path);

            document.querySelector("path").setAttribute("d", path);

            t += 3;

            requestAnimationFrame(animate);
        }

        animate()
    </script>
</body>

</html>