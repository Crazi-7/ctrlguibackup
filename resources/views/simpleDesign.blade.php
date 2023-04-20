<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{URL('jquery.js')}}" type="text/javascript"></script>
    <script src="{{URL('jquery.browser.js')}}"></script>
    <script src="{{URL('jquery-ui.js')}}"></script>
    <script src="{{URL('jquery.layout.js')}}"></script>
    
   
    <script src="{{URL('draw2d.js')}}" type="text/javascript"></script>

    <script src="{{URL('engine/Application.js')}}"></script>
	<script src="{{URL('engine/View.js')}}"></script>
	<script src="{{URL('engine/Toolbar.js')}}"></script>
    <script src="{{URL('engine/PropertyPane.js')}}"></script>
    <script type="text/javascript">
    var app;
    window.addEventListener("DOMContentLoaded", () => { //check if loaded
        document.getElementById("show").addEventListener("click", toggleSideBar);
        document.getElementById("hide-button").addEventListener("click", toggleSideBar);
        document.getElementById("edit-bar-button").addEventListener("click", toggleEdit);
        const allComponents = document.getElementsByClassName("component-wrapper");
        
        Array.prototype.forEach.call(allComponents, (item) => {
            item.addEventListener('click', addComponent);
        });
        // grab to pan is something you need to import http://rob--w.github.io/grab-to-pan.js/demo.html
        // document.getElementById('hand-pan').onchange = function () {
        //     if (this.checked) g2p.activate();
        //     else g2p.deactivate();
        // };
        // var scrollableContainer = document.getElementById('scrollable-container');
        // var g2p = new GrabToPan({
        //     element: scrollableContainer, // required
        // });
        // g2p.activate();


        app  = new example.Application();
        // 10   = Grid size
        // true = consider zoom and resize the grid
        app.view.installEditPolicy(new draw2d.policy.canvas.SnapToGeometryEditPolicy());
        app.view.installEditPolicy(new draw2d.policy.canvas.SnapToInBetweenEditPolicy());
        app.view.installEditPolicy(new draw2d.policy.canvas.SnapToCenterEditPolicy());
        app.view.installEditPolicy( new draw2d.policy.connection.DragConnectionCreatePolicy({
            createConnection: function(sourcePort, targetPort){
                var c = new draw2d.Connection();
                
                c.setColor("#656565")
                c.setOutlineStroke(1);
                c.setRadius(3);
                c.setStroke(5);
                c.setRouter(new draw2d.layout.connection.InteractiveManhattanConnectionRouter());
                c.setTargetDecorator(new draw2d.decoration.connection.ArrowDecorator());
                c.getTargetDecorator().setBackgroundColor('#656565');
                c.getTargetDecorator().setDimension(30,30);
                return c;
            }
        }));
    });
    function toggleSideBar()
    {
        const sidebarEl = document.getElementsByClassName("sidebar")[0]; //find element 
        sidebarEl.classList.toggle("sidebar--isHidden"); //toggle?
        if (sidebarEl.classList.length == 1)
        {
            const addButton = document.getElementsByClassName("tool")[3];
            addButton.classList.add("clicked");
            const addbar = document.getElementsByClassName("add-bar")[0];
            addbar.classList.remove("hidden");
            const editbar = document.getElementsByClassName("edit-bar")[0];
            editbar.classList.add("hidden");
        }
        else
        {
            const addButton = document.getElementsByClassName("tool")[3];
            addButton.classList.remove("clicked");
        }
        const moveButtons = document.getElementsByClassName("buttons")[0];
        moveButtons.classList.toggle("buttons--isMoved");
        const editButton = document.getElementsByClassName("tool")[2];
        editButton.classList.remove("clicked");
        //document.getElementById("toggle").innerHTML = sidebarEl.classList.contains("sidebar--isHidden")? "Show Sidebar": "Hide Sidebar";
    }
    function toggleEdit()
    {
        const sidebarEl = document.getElementsByClassName("sidebar")[0]; //find element 
        sidebarEl.classList.toggle("sidebar--isHidden"); //toggle?
        if (sidebarEl.classList.length == 1)
        {
            const editButton = document.getElementsByClassName("tool")[2];
            editButton.classList.add("clicked");
            
            const addbar = document.getElementsByClassName("add-bar")[0];
            addbar.classList.add("hidden");
            const editbar = document.getElementsByClassName("edit-bar")[0];
            editbar.classList.remove("hidden");
        } else
        {
            const editButton = document.getElementsByClassName("tool")[2];
            editButton.classList.remove("clicked"); 
        }
        const moveButtons = document.getElementsByClassName("buttons")[0];
        moveButtons.classList.toggle("buttons--isMoved");
        const addButton = document.getElementsByClassName("tool")[3];
        addButton.classList.remove("clicked");
        //document.getElementById("toggle").innerHTML = sidebarEl.classList.contains("sidebar--isHidden")? "Show Sidebar": "Hide Sidebar";
    }
    </script>
    <script src="{{URL('guiFunctions.js')}}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Design tester</title>

    <style>
        body 
        {
            margin: 0px;
            background-color: #414141;
            color:#c696d8;
            font-family: Arial, sans-serif;
            height: 100vh;
            width: 100%;
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
            width: 600px;
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
            top: 150px;
            left: 20px;   
            border-radius: 10px;       
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
        }
        .subheader-element>span>i, #hide-button>i, .the-button>span>i, .the-button>i
        {
            font-size: 50px;
        }
        .toolbar>.tool>i 
        {
            font-size: 50px;
            width: 100%;
            margin: 10px 0;
        }
        .tool {
            width: 100%;
        }
        #first-tool 
        {
            margin-top:20px;
        }
        #last-tool
        {
            margin-bottom:20px;
        }
        .ft 
        {
            border-radius: 10px 10px 0 0;
        }
        .lt 
        {
            border-radius: 0 0 10px 10px;
        }
        .clickable:hover 
        {
            filter: brightness(0.6);
            cursor: pointer;
            background-image: linear-gradient(rgb(0 0 0/40%) 0 0);
        }
        .clickable2:hover 
        {
            cursor: pointer;
            background-image: linear-gradient(rgb(0 0 0/80%) 0 0);
        }
        .clicked
        {
            filter: brightness(0.6);
            background-image: linear-gradient(rgb(0 0 0/40%) 0 0);
            color: #c696d8;
            font-weight: bold;
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
        .sidebar
        {
            height: 100%;
            width: 600px;
            right: 0;
            position: fixed;
            background-color: #4c4c4c;
            transition: transform 300ms ease-out;
        }
        #hide-button
        {
            position: absolute;
            left:0;
            top: 45%;
            height: 10%;
            width: 10%;
            border-radius: 5px;
            background-color: #5b5b5b; 
        }
        .sidebar--isHidden
        {
            transform: translateX(600px);
            transition: transform 300ms ease-out;
        }
        .buttons--isMoved
        {
            transform: translateX(-600px);
            transition: transform 300ms ease-in;
        }
        .zoom-buttons
        {
            position: relative;
            bottom: 150px;
            right: 20px;
            width:70px;
            margin: 0;
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            align-items: center;
        }
        .zoom-buttons > *
        {
            height: 60px;
            width: 60px;
            background-color: #5b5b5b;
            
        }
        .zoom 
        {
            border-radius: 20px 20px 0 0;
        }
        .unzoom 
        {
            border-radius: 0px 0px 20px 20px;
        }
        .buttons
        {
            transition: transform 300ms ease-out;
            position:absolute;
            bottom:0;
            right:0;
            margin:0;
        }
        .simulate-button
        {
            position: fixed;
            padding: 15px;
            bottom: 40px;
            right: 120px;
            font-size: 50px;
            font-weight: bold;
            background-color: #5b5b5b;
            border-radius: 20px;
        }
        .add-bar
        {
            margin-left:12%;
        }
        .add-bar-header 
        {
            font-size: 40px;
            color:#d9d9d9;
            background-color: #b475cc;
            font-weight: bold;
            width:300px;
            border-radius: 20px;
            margin-top:30px;
            margin-bottom:30px;
            padding:8px;

        }
        .add-bar-sinks 
        {
            color:#ded74e;
        }
        .add-bar-functions 
        {
            color:#4ae159;
        }
        .add-bar-sources
        {
            color:#41a7eb;
        }
        .add-section-head 
        {
            font-size: 30px;
        }
        .add-section-body
        {
            height:150px;
            background-color: #575757;
            width:95%;
            margin: 5px 0;
            border-radius: 10px;
            display: flex;
            flex-flow: row nowrap;
            justify-content: flex-start;
            column-gap: 10px;
            align-items: center;
            overflow-x:scroll;
            overflow-y:hidden;
        }
        .component-wrapper 
        {
            height:140px;
            width:120px;
            display: flex;
            flex-flow: column nowrap;
            justify-content:center;
            align-items: center;
        }
        .component 
        {
            width:120px;
            height:100px;

        }
        .component>i 
        {
            font-size: 70px;
        
        }
        .component-header 
        {
            height: 40px;
            text-align: center;
        }
        /* width */
        ::-webkit-scrollbar {
        
        height: 15px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #575757;
        border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #454545;
        border-radius: 15px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #404040;
        }
        #canvas 
        {
            height:100%;
            width:100%;
        }
         button 
        {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
            height:100%;
            width:100%;
        } 
        span
        {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
            display: block;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
        }
        #canvas
        {
            position:absolute;
            overflow: scroll;
            height:100%;
            width:100%;
        }
         /* width */
        #canvas::-webkit-scrollbar {
            display:none;
        }
        /* Track */
        #canvas::-webkit-scrollbar-track {
        display:none;
        }
        /* Handle */
        #canvas::-webkit-scrollbar-thumb {
        display:none;
        }
        /* Handle on hover */
        #canvas::-webkit-scrollbar-thumb:hover {
        display:none;
        }
        .hidden 
        {
            display:none;
        }
    </style>
</head>
<body id="container">
    <div id="canvas"> </div>
        <!-- SUBHEADER-->
        <div class="subheader">
            <div class="subheader-element clickable"><p>File</p></div>
            <div class="subheader-element clickable"><p>Save</p></div>
            <div class="subheader-element clickable" id="undo-button"><i class="material-symbols-outlined vcentre">undo</i></div>
            <div class="subheader-element clickable" id="redo-button"><i class="material-symbols-outlined vcentre">redo</i></div>
        </div>

        <!-- TOOL BAR-->
        <div class="toolbar">
        <div class="tool clickable ft"> <i class=" material-symbols-outlined vcentre" id="first-tool">arrow_selector_tool</i> </div>
        <div class="tool clickable" id="hand-pan"><i class="material-icons vcentre">back_hand</i></div>
        <div class="tool clickable" id="edit-bar-button"><i class="material-icons vcentre">edit</i></div>
        <div class="tool clickable" id="show"><i class=" material-icons vcentre">add_box</i></div>
        <div class="tool clickable lt"><i class="last-tool material-icons vcentre" id="last-tool">brush</i></div>
        
        </div>

        <!-- OVERLAY BUTTONS-->
        <div class="buttons">
            <div class="button-element zoom-buttons">
                <div class="clickable zoom vcentre" >
                    <button id="zoom-in-button" class="the-button"><i class="material-icons vcentre">add</i></button>
                </div>
                <div class="clickable fit-screen vcentre" id="fit-button">
                    <button id="fit-button" class="the-button"><i class="material-icons">fit_screen</i></button>
                </div>
                <div class="clickable unzoom vcentre" id="zoom-out-button">
                    <button id="zoom-out-button" class="the-button"><i class="material-icons vcentre">remove</i></button>
                </div>
            </div>
            <div class="button-element simulate-button clickable">Simulate</div>
        </div>

        <!-- SIDEBAR-->
        <div class="sidebar sidebar--isHidden">
            <!-- ADDBAR-->
            <div class="add-bar">
                <div class="vcentre">
                    <div class="add-bar-element add-bar-header vcentre">Add Element:</div> 
                </div>

                <!-- SOURCES-->
                <div class="add-bar-element add-bar-sources">
                    <div class="add-section-head">Sources:</div>
                    <div class="add-section-body">
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">escalator</i></div>
                            <div class="component-header vcentre sources">Step</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">priority_high</i></div>
                            <div class="component-header vcentre sources">Impulse</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">timeline</i></div>
                            <div class="component-header vcentre sources">Polynomial</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">waves</i></div>
                            <div class="component-header vcentre sources">Trig</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">repeat_one</i></div>
                            <div class="component-header vcentre sources">Constant</div>
                        </div>
                    </div>
                </div>


                <!-- FUNCTIONS-->
                <div class="add-bar-element add-bar-functions">
                    <div class="add-section-head">Functions:</div>
                    <div class="add-section-body">
                    <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">playlist_add</i></div>
                            <div class="component-header vcentre functionsy">Adder</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">functions</i></div>
                            <div class="component-header vcentre functionsy">Integrator</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">tune</i></div>
                            <div class="component-header vcentre functionsy">Transfer Function</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">close</i></div>
                            <div class="component-header vcentre functionsy">Gain</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">input</i></div>
                            <div class="component-header vcentre functionsy">Buffer</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">waves</i></div>
                            <div class="component-header vcentre functionsy">Trig</div>
                        </div>
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">timeline</i></div>
                            <div class="component-header vcentre functionsy">Polynomial</div>
                        </div>
                    </div>
                </div>


                <!-- SINKS-->
                <div class="add-bar-element add-bar-sinks">
                    <div class="add-section-head">Sinks:</div>
                    <div class="add-section-body">
                        <div class="component-wrapper clickable">
                            <div class="component vcentre"><i class="material-icons vcentre">desktop_windows</i></div>
                            <div class="component-header vcentre sinks">Scope</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- EDIT BAR-->
            <div class="edit-bar">
                <div class="vcentre">
                    <div class="add-bar-element add-bar-header vcentre">Edit Element:</div> 
                </div>
                
                <div id="propertyPane">
                </div>
                <div id="properties">
                </div>
            </div>

            <div id="hide-button" class="clickable vcentre"><i class="material-icons">chevron_right</i></div>
        </div>
    
    
</body>
</html>