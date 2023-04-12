<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Design tester</title>
    <script>
    


    </script>
    <style>
        body 
        {
            margin: 0px;
            background-color: #414141;
            color:#aeaeae;
        }
        p
        {
            display: inline;
        }
        .subheader
        {
            height: 60px;
            background-color: #4c4c4c;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            font-size: 50px;
            font-weight:bold;
            display: flex;
            flex-flow: row nowrap;
            justify-content: flex-start;
            column-gap: 0;
            align-items: center;
        }
        .subheader-element > *
        {
            margin: 0px 20px;
            height: 100%;

        }
        .subheader-element 
        {
            height:100%;
        }
        .toolbar
        {
            width: 60px;
            background-color: #5b5b5b;
            position: fixed;
            top: 80px;
            left: 20px;
            width: 60px;
            height: 500px;

            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            align-items: center;
        }
        .subheader-element>i 
        {
            font-size: 50px;
        }
        .toolbar>.tool>i 
        {
            font-size: 50px;
            width: 100%;
            margin: 5px 0;

        }
        .tool {
            width: 100%;
        }
        .clickable:hover 
        {
            filter: brightness(0.6);
            cursor: pointer;
            background-image: linear-gradient(rgb(0 0 0/40%) 0 0);
        }
        .clicked
        {
            filter: brightness(0.6);
            background-image: linear-gradient(rgb(0 0 0/40%) 0 0);
        }

        .material-symbols-outlined {
        font-variation-settings:
        'FILL' 1,
        'wght' 400,
        'GRAD' 0,
        'opsz' 48
        }
        .vcentre 
        {
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<body>
    <div class="subheader">
        <div class="subheader-element clickable"><p>File</p></div>
        <div class="subheader-element clickable"><p>Save</p></div>
        <div class="subheader-element clickable"><i class="material-symbols-outlined vcentre">undo</i></div>
        <div class="subheader-element clickable"><i class="material-symbols-outlined vcentre">redo</i></div>
    </div>

    <div class="toolbar">
    <div class="tool clickable"> <i class="material-symbols-outlined vcentre">arrow_selector_tool</i> </div>
    <div class="tool clickable"><i class="material-icons vcentre">back_hand</i></div>
    <div class="tool clickable"><i class="material-icons vcentre">edit</i></div>
    <div class="tool clickable"><i class="material-icons vcentre">brush</i></div>
    <div class="tool clickable"><i class="material-icons vcentre">add</i></div>
    </div>

    <div class="buttons"></div>
    <div class="sidebar"></div>
    <div class="downbar"></div>
</body>
</html>