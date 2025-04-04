<?php $page = "projekte"; ?>
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
    <div class='container'>
        <div class=' container' id="before2019_Eventausstattung">
        </div>

        <!--        <button class='collapsible' onClick="get10ListElements(this,'2019','SM','Eventausstattung',10,0);">ältere Einträge ↓</button>-->
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
    <div class='container'>
        <div class=' container' id="before2017_Filmausstattung">
        </div>
        <!--        <button class='collapsible' onClick="get10ListElements(this,'2017','SM','Filmausstattung und Baubühne',10,0);">ältere Einträge ↓</button>-->
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

    <div class='container'>
        <div class='container' id="before2018_Messebau">
        </div>
    </div>
    <!--   -->
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
    <div class='container'>
        <div class=' container' id="before2017_Filmausstattung">
        </div>
        <!--        <button class='collapsible' onClick="get10ListElements(this,'2017','SM','Filmausstattung und Baubühne',10,0);">ältere Einträge ↓</button>-->
    </div>
    <script>

        // function getCollapsableList(element, year, operator, category, limit = 0, offset = 0) {
        //     if (!$(element).data('clicked')) {
        //         $(element).data('clicked', true);
        //         let parent = $(element).parent();
        //
        //         // let Parent = element.nextElementSibling;
        //         let target = parent.first();
        //         getList(target, year, operator, category, limit, offset);
        //         showMore(parent);
        //
        //     } else {
        //         showMore(element);
        //     }
        // }


        function openModal(id) {
            if (!$("#modal_" + id).data('clicked')) {

                getPictureList(id).then(function (result) {
                    $("#" + id).html(result);
                    $("#modal_" + id).modal()
                    $("#modal_" + id).data('clicked', true);
                    showDivs(id, slideIndex);

                });
            } else {
                $("#modal_" + id).modal()
            }
        }

        function closeModal(id) {
            $("#modal_" + id).toggle();
        }

        function getProjects(year, operator, category, limit = 0, offset = 0) {
            return new Promise((result) => {
                $.ajax({
                    url: "",
                    type: "post",
                    data: {
                        actn: "getList",
                        ctrl: "Projects",
                        operator: operator,
                        year: year,
                        category: category,
                        limit: limit,
                        offset: offset,

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
                                '<p>' + value["info"] + '</p>';

                            list = list + '<div class="sozialLinks" style="display:flex;">';

                            $.each(value["sozialLinks"], function (index, value) {

                                list = list + '<a  class="sozialLink" style="display:flex;" href="' + value["url"] + '"target="_blank"><img alt="" src="http://<?=$config->domain;?>/img/sozials/' + value["type"] + '_sozial.png" style="width:42px;height:42px;"></a>';
                            });
                            list = list + '</div>';


                            //todo Bilder anzeigen Button nur wenn Bilder vorhanden
                            if (value["picture_modal"] == "show") {
                                list = list + '<button class="picPreview" onclick="openModal(' + value["id"] + ')">Show Pictures</button>';
                            }
                            list = list + '<div id="' + value["id"] + '">' +
                                '</div>' +
                                '</div>';
                        });

                        // list = list +'<button class="collapsible" onClick="get10ListElements(\'this\',"'+year+'","'+operator+'","'+category+'",' + limit +','+offset+')">ältere Einträge ↓</button>';

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
                            '<div class="arrow-div-flex">' +
                            '<p id="caption"></p>' +
                            '<span class="modal-left-arrow w3-btn" onclick="plusDivs(' + id + ',-1)">❮</span>' +
                            '<span class="modal-right-arrow w3-btn" onclick="plusDivs(' + id + ',1)">❯</span>' +
                            '</div>' +
                            '<div class="imgPreview" style="display: flex;">';

                        // '<div style="display: flex; align-content: space-between;">';

                        $.each(elemtentArray, function (index, value) {
                            list = list + '<div>' +
                                '<img src="' + value + '"  onclick="currentDiv(' + id + ',' + index + ')" alt="">' +
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
            if (n > slide.length - 1) {
                slideIndex = 0
            }
            if (n < 0) {
                slideIndex = slide.length - 1;
            }
            for (i = 0; i < slide.length; i++) {
                $(".projectPictures_" + id).eq(i).hide();
            }
            $(".projectPictures_" + id).eq(slideIndex).show();
        }

        // load projects

        function get10ListElements(button,element, year, operator, category, limit = 0, offset = 0) {
            var element = element.replace("#", '\#');
            button.remove();
            getList(element, year, operator, category, limit, offset);

        }


        function getList(element, year, operator, category, limit = 0, offset = 0) {

            var element = element.replace("#", '\#')
            let parent = $(element);


            //todo add limit and offset calculation for MORE"ältere Einträge" L.71
            getProjects(year, operator, category, limit, offset).then(function (response) {
                offset = offset + limit;
                //todo try to keep current element(in this case button) and write and then add at the end of list
                $(parent).html($(parent).html()+response);
                $(parent).html($(parent).html()+'<button class="collapsible" onClick="get10ListElements(this,\'' + element + '\',\'' + year + '\',\'' + operator + '\',\'' + category + '\',' + limit + ',' + offset + ')">ältere Einträge ↓</button>');
                $.scrollTo($(":target"));
            });
        }

        // get10ListElements("#after2019_Eventausstattung", "2019", "BGEQ", 'Eventausstattung', 10, 0);
        // get10ListElements("#after2017_Filmausstattung", "2017", "BGEQ", "Filmausstattung und Baubühne", 10, 0);
        // get10ListElements("#after2018_Messebau", "2018", "BGEQ", 'Messebau', 10, 0);
        getList("#after2019_Eventausstattung", "2019", "BGEQ", 'Eventausstattung', 10, 0);
        getList("#after2017_Filmausstattung", "2017", "BGEQ", "Filmausstattung und Baubühne", 10, 0);
        getList("#after2018_Messebau", "2018", "BGEQ", 'Messebau', 10, 0);


        //SM   = smaller than
        //SMEQ = smaller or equals than
        //BG   = bigger than
        //BGEQ = bigger or equals than
    </script>
</div class="content">
