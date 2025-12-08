<div class="jbView">
    <input id='spltrData' type="hidden" spltr-data=''>
    <div class='spltr-head'>
        <h5>Junction Box Splitters</h5>
        <button class="btn btn-sm btn-warning" onclick="closeJBVw()">Close</button>
    </div>
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

        margin: 0 0 10px 0;

        & h5 {
            font-family: oswald;
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
        $('.spltr-body').append('<ul class="spltrList"></ul>')
        data.forEach((i, idx)=>{
            $('.spltrList').append(`<li>ID: ${i[0]} | Ratio: ${i[1]} | Tray: ${i[2]}</li>`)
        })
    }
</script>