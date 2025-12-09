<div class="jbView">
    <input id='spltrData' type="hidden" spltr-data=''>
    <div class='spltr-head mb-2'>
        <h5>Junction Box Splitters</h5>
        <div>
            <button id="addSpltrBtn" class="btn btn-sm btn-info">Add Splitter</button>
            <button class="btn btn-sm btn-warning" onclick="closeJBVw()">>>Close</button>
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
        padding: 1rem 1rem 2rem 1rem;

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
        console.log(jbId)
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
                console.log(data)
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
                    <th scope="col">#</th>
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
                <th scope="row">${i[0]}</th>
                <td>${i[1]}</td>
                <td>${i[2]}</td>
            </tr>`)
        })
    }
</script>