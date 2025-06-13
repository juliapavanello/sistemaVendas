<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        background-color: black;
        color: white;
    }

    div {
        width: 100%;
        aspect-ratio: 8/1;
        background-color: rgba(34, 34, 34, 0.5);
        border-radius: 15px;
        margin-top: 20px;
    }

    .divBlur {
        background-color: rgba(239, 1, 141, 0.5);
        width: 527px;
        aspect-ratio: 1/1;
        border-radius: 100%;
        filter: blur(150px);
        position: absolute;
        top: 100px;
        left: 700px;
        z-index: -50;
    }
</style>

<body>
    <div>
        eae
    </div>
    <div>
        eae
    </div>
    <div>
        eae
    </div>
    <div class="divBlur">

    </div>
</body>

</html>