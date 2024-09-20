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
    <button class='collapsible' onClick="getCollapsableList(this,'2019','SM','Eventausstattung');">ältere Einträge ↓
    </button>
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
    <button class='collapsible' onClick="getCollapsableList(this,'2017','SM','Filmausstattung und Baubühne');">ältere
        Einträge ↓
    </button>
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
    <button class='collapsible' onClick="getCollapsableList(this,'2018','SM','Messebau');"
    '>ältere Einträge ↓</button>
    <div class='collapsed'>
        <div class='container' id="before2018_Messebau">
        </div>
    </div>

    <script>
        function getCollapsableList(element, year, operator, category) {
            if (!$(element).data('clicked')) {
                $(element).data('clicked', true);

                let targetParent = element.nextElementSibling;
                let target = targetParent.firstElementChild;
                getProjects(year, operator, category).then(function (result) {
                    $(target).html(result);
                    showMore(element);
                });
            } else {
                showMore(element);
            }
        }

        function getList(element, year, operator, category) {
            getProjects(year, operator, category).then(function (result) {
                $(element).html(result);
            });
        }

        function openModal(id) {
            if (!$("#modal_" + id).data('clicked')) {

                getPictureList(id).then(function (result) {
                    $("#" + id).html(result);
                    $("#modal_" + id).modal()
                    $("#modal_"+id).data('clicked', true);
                    showDivs(id, slideIndex);

                });
            }else{
                $("#modal_" + id).modal()
            }
        }

        function closeModal(id) {
            $("#modal_" + id).toggle();
        }

        function getProjects(year, operator, category) {
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
                                '<div class="box">' +
                                '<h2>' + value["titel"] + '</h2>' +
                                '<p>' + value["beschreibung"] + '</p>' +
                                '<p>' + value["info"] + '</p>' +
                                '<button class="picPreview" onclick="openModal(' + value["id"] + ')">Show Pictures</button>' +
                                '<div id="' + value["id"] + '">' +
                                '</div>' +
                                '</div>';
                        });
                        result(list);
                    }
                })
            });
        }

        function getPictureList(id = null) {
            if (id == null) {
                return;
            }
            return new Promise((result) => {
                $.ajax({
                    url: "",
                    type: "post",
                    data: {
                        actn: "getPictures",
                        ctrl: "Projects",
                        id: id
                    },
                    success: function (response) {
                        var elemtentArray = JSON.parse(response);
                        console.log(elemtentArray);
                        var list = ' <div style="background-color: #151313" id="modal_' + id + '" class="w3-modal w3-black">' +
                            '<div class="w3-modal-content">' +
                            '<div class="w3-content" style="max-width:1200px">';
                        $.each(elemtentArray, function (index, value) {
                            list = list + '<img  class="projectPictures_' + id + '" src="' + value + '">';
                        });
                        list = list +
                        '<div class="w3-row w3-black w3-center">' +
                            '<div class="arrow-div-flex">'+
                                '<p id="caption"></p>' +
                                '<span class="modal-left-arrow w3-btn" onclick="plusDivs(' + id + ',-1)">❮</span>' +
                                '<span class="modal-right-arrow w3-btn" onclick="plusDivs(' + id + ',1)">❯</span>' +
                            '</div>' +
                            '<div class="imgPreview" style="display: flex;">';

                        // '<div style="display: flex; align-content: space-between;">';

                        $.each(elemtentArray, function (index, value) {
                            list = list +'<div>' +
                                '<img src="' + value + '"  onclick="currentDiv(' + id + ','+index+')" alt="">'+
                                '</div>';
                        });
                        list = list +
                            '</div> ' +
                            '</div> <!-- End row -->' +
                            '</div> <!-- End content -->' +
                            '</div> <!-- End modal content -->' +
                            '</div> <!-- End modal -->';
                        result(list);


                        // var elemtentArray = JSON.parse(response);
                        // console.log(elemtentArray);
                        // var list =
                        // '<div class="slider">'+
                        //     '<div class="slide-track">';
                        // $.each(elemtentArray, function (index, value) {
                        //     list = list +
                        //         '<div class="slide">'+
                        //         '<img src="'+value+'" height="100" width="250" alt="" />'+
                        //         '</div>';
                        // });
                        // list = list + '</div> </div>';

                    }
                })
            });
        }


        var slideIndex = 0;

        function plusDivs(id, n) {
            showDivs(id, slideIndex += n);
        }

        function currentDiv(id, n) {
            showDivs(id, slideIndex = n);
        }

        function showDivs(id, n) {
            var i;
            var slide = $(".projectPictures_" + id);
            var captionText = document.getElementById("caption");
            console.log(slide);
            if (n > slide.length-1) {
                slideIndex = 0
            }
            if (n < 0) {
                slideIndex = slide.length -1;
            }
            for (i = 0; i < slide.length; i++) {
                $(".projectPictures_" + id).eq(i).hide();
            }

            $(".projectPictures_" + id).eq(slideIndex).show();
        }

        // load projects
        getList($('#after2019_Eventausstattung'), '2019', 'BGEQ', 'Eventausstattung');
        getList($('#after2017_Filmausstattung'), '2017', 'BGEQ', 'Filmausstattung und Baubühne');
        getList($('#after2018_Messebau'), '2018', 'BGEQ', 'Messebau');


        //SM   = smaller than
        //SMEQ = smaller or equals than
        //BG   = bigger than
        //BGEQ = bigger or equals than

    </script>
</div class="content">
