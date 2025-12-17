<div class="jbView">
    <input id='spltrData' type="hidden" spltr-data=''>
    <div class='spltr-head mb-2'>
        <div class="d-flex align-items-center">
            <h5>JB Splitters</h5>
            <button id="addSpltrBtn" class="btn"><img src='./inc/img/add.jpg' title="Add Splitter"></button>
        </div>
        <div class="d-flex align-items-center">
            <button class="clsSpltrVwBtn btn btn-sm btn-warning d-flex align-items-center" style='font-size: 1rem;' onclick="closeJBVw()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-player-track-next">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M2 5v14c0 .86 1.012 1.318 1.659 .753l8 -7a1 1 0 0 0 0 -1.506l-8 -7c-.647 -.565 -1.659 -.106 -1.659 .753z" />
                    <path d="M13 5v14c0 .86 1.012 1.318 1.659 .753l8 -7a1 1 0 0 0 0 -1.506l-8 -7c-.647 -.565 -1.659 -.106 -1.659 .753z" />
                </svg>
                <p class="p-0 m-0">CLOSE</p>
            </button>
        </div>
    </div>
    <hr>
    <div class="spltr-body"></div>
</div>

<style>
    .jbView {
        display: block;
        height: 100%;
        width: 400px;
        padding: .5rem 1rem 2rem 1rem;

        position: absolute;
        right: -200px;
        z-index: 9997;

        transition: transform 300ms ease-in-out;

        background-color: #fff;
    }

    .spltr-head {
        display: flex;
        justify-content: space-between;
        align-items: center;

        & h5 {
            font-family: oswald;
            margin: 0;
        }

        .clsSpltrVwBtn {
            height: 30px;
        }

        #addSpltrBtn {
            border: none;

            & img {
                aspect-ratio: 1;
                width: 30px;
                border-radius: 10px;
                box-shadow: 0 0 3px #333;
            }
        }
    }

    .spltr-body {
        .spltrList {
            list-style: none;
            padding: 0;
        }

        .no-spltr {
            margin-top: 10px;
            color: #888;
            font-family: oswald;
        }
    }
</style>

<script defer>
    jbVw = false

    function openJBVw(jbId){
        if(!jbVw && poleVw){
            $('.jbView').css('transform', 'translateX(-800px)')
            jbVw = true
            get_spltrs_data(jbId)
            $('#addSpltrBtn').attr('onclick', `addSpltrs(${jbId})`)
        }
    }

    function closeJBVw() {
        poleVw && $('.jbView').css('transform', 'translateX(-400px)')
        !poleVw && $('.jbView').css('transform', 'translateX(200px)')
        jbVw = false
    }

    function get_spltrs_data(jbid){
        $.ajax({
            type: 'POST',
            url: './inc/func/func_updateJBTbl.php',
            cache: false,
            data: {
                getSpltr: jbid
            },
            success: function(data){
                $('.spltr-body').empty()
                if(!data){
                    $('.spltr-body').append('<h5 class="no-spltr">No Splitter Installation</h5>')
                }
                else {
                    data = JSON.parse(data)
                    document.getElementById('spltrData').setAttribute('spltr-data', data)
                    lsSpltrs(data)
                }
            },
            error: (error, status, xhr)=>{ console.log(xhr) }
        })
    }

    function lsSpltrs(data){
        $('.spltr-body').append(`   
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Desc</th>
                    <th scope="col">Ratio</th>
                    <th scope="col">Tray</th>
                </tr>
            </thead>
            <tbody class="spltrList">

            </tbody>
        </table>`)

        data.forEach((i, idx)=>{
            $('.spltrList').append(`
            <tr>
                <th scope="row">${i[3]}</th>
                <td>${i[1]}</td>
                <td>${i[2]}</td>
            </tr>`)
        })
    }
</script>