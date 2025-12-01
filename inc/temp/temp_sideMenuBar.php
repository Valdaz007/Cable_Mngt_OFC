        <div class="sideMenuBar p-3">
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="addPole()">Add Pole</button>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="addJB()">Add Enclosure</button>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="addSpltrs()">Add Splitter</button>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="addPole()">Add Cable</button>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="addOLT()">Add OLT</button>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="addPole()">Add ONU</button>
            <br><br>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="pomVw()">POM</button>
            <button class="btn btn-sm btn-warning w-75 mb-2" onclick="mdgVw()">MADANG</button>
        </div>

        <style>
            .sideMenuBar {
                min-width: 200px;
                width: 200px;
                height: 100%;

                background-color: skyblue;

                display: flex;
                flex-direction: column;
                align-items: center;
                z-index: 9999;

            }
        </style>