<?php
$page = "projekte";
?>

<body>
<div class="content">
    <div class="textHeader" id="sticky">
        <h1>Projekte</h1>
    </div>

    <!-- EVENTS  -->
    <div class='container' id='event'>
        <div class='image'>
            <img src='img/diver_white.svg'/>
        </div>
        <div class='box headingCenter'>
            <h1>EVENTAUSSTATTUNG</h1>
        </div>
        <div class='container' id="after2019_Eventausstattung">
        </div>
    </div>
    <!-- +++++ ältere Einträge +++++ -->
    <button class='collapsible' onClick="getCollapsableList(this,'2019','SM','Eventausstattung');">ältere Einträge ↓</button>
    <div class='collapsed'>
        <div class='container' id="before2019_Eventausstattung">
        </div>
    </div>

    <!-- FILM  -->
    <div class='container' id='film'>
        <div class='image'>
            <img src='img/piratenkarre_white.svg'/>
        </div>
        <div class='box headingCenter'>
            <h1>FILM / WERBUNG / IMAGEFILM</h1>
        </div>
        <div class='container' id="after2017_Filmausstattung">
        </div>
    </div>
    <!-- +++++ ältere Einträge +++++ -->
    <button class='collapsible' onClick="getCollapsableList(this,'2017','SM','Filmausstattung und Baubühne');">ältere Einträge ↓</button>
    <div class='collapsed'>
        <div class='container' id="before2017_Filmausstattung">
        </div>
    </div>

    <!-- MESSE  -->
    <div class='container' id='messe'>
        <div class='image'>
            <img src='img/pinguin_white.svg'/>
        </div>
        <div class='box headingCenter'>
            <h1>MESSEBAU</h1>
        </div>
        <div class='container' id="after2018_Messebau">
        </div>
    </div>
    <!-- +++++ ältere Einträge +++++ -->
    <button class='collapsible' onClick="getCollapsableList(this,'2018','SM','Messebau');"'>ältere Einträge ↓</button>
    <div class='collapsed'>
        <div class='container' id="before2018_Messebau">
        </div>
    </div>

    <script>
        function getCollapsableList(element, year ,operator, category){
            if(!$(element).data('clicked')){
                $(element).data('clicked', true);
                var list
                let targetParent = element.nextElementSibling;
                let target = targetParent.firstElementChild;
                getAjaxCall(year,operator,category).then(function (result){
                    $(target).html(result);
                    showMore(element);
                });
            }else{
                showMore(element);
            }
        }

        function getList(element, year,operator, category){

            getAjaxCall(year,operator,category).then(function (result){
                $(element).html(result);
            });
        }

        function getAjaxCall(year, operator, category) {
            return new Promise((result) => {
                $.ajax({
                    url: "",
                    type: "post",
                    data: {
                        actn: "getList",
                        ctrl: "Projects",
                        operator: operator,
                        year: year,
                        category: category
                    },
                    success: function (response) {
                        var elemtentArray = JSON.parse(response);
                        console.log(elemtentArray);
                        var list = "";
                        $.each(elemtentArray, function (index, value) {
                            list = list +
                                '<div id="' + value["id"] + '" class="box">' +
                                '<h2>' + value["titel"] + '</h2>' +
                                '<p>' + value["beschreibung"] + '</p>' +
                                '<p>' + value["info"] + '</p>' +
                                '</div>';
                        });
                        result(list);
                    }
                })
            });
        }
        getList($('#after2019_Eventausstattung'),'2019','BGEQ','Eventausstattung');
        getList($('#after2017_Filmausstattung'),'2017','BGEQ','Filmausstattung und Baubühne');
        getList($('#after2018_Messebau'),'2018','BGEQ','Messebau');


        //SM   = smaller than
        //SMEQ = smaller or equals than
        //BG   = bigger than
        //BGEQ = bigger or equals than

    </script>
</div class="content">

