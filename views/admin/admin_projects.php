<div class='main'>
    <input type="hidden" id="selectedID" name="selectedID" value="">
    <div id="AdminProjectsContainer" class="content">
        <div class="container">
            <h1>Admin Projekte</h1>
        </div>
        <div class="container">
            <span>ProjectsEditor</span>
        </div>
        <div class="projectListContainer container">
            <div class="projectList_ projectTable">
                <div class="projectList_ projectTableHeading">
                    <div class="projectList_ projectTableRowSearch">
                        <div class="projectList_ projectTableSearch"></div>
                        <div class="projectList_ projectTableSearch"></div>
                        <div class="projectList_ projectTableSearch"></div>
                        <div class="projectList_ projectTableSearch">
                            <input id="searchBar" placeholder="suchbegriff" value="">
                            <button id="searchButton" onclick="getList()">Suchen</button>
                        </div>
                    </div>
                    <div class="projectList_ projectTableRow">
                        <!--                        <div class="projectList_ projectTableHead"><button id="searchButton" onclick="getOrder("title")">Titel</button></div>-->
                        <div class="projectList_ projectTableHead">Titel</div>
                        <div class="projectList_ projectTableHead">Kategorie</div>
                        <div class="projectList_ projectTableHead">Datum</div>
                        <div class="projectList_ projectTableHead">Optionen</div>
                    </div>
                </div>
                <div id="projects_List" class=" projectList_ projectTableBody">
                    <?php $controller->loadProjects();
                    foreach ($controller->projectList as $project) { ?>
                        <div id="row_<?= $project["id"] ?>" class="projectList_ projectTableRow">
                            <div class="projectList_ projectTableCell">
                                <?= $project["title"] ?>
                            </div>
                            <div class="projectList_ projectTableCell">
                                <?= $project["category"] ?>
                            </div>
                            <div class="projectList_ projectTableCell">
                                <?= $project["date"] ?>
                            </div>
                            <div class="projectList_ projectTableCell">
                                <button class="editButton" onclick="showDetailsWindow('<?= $project["id"] ?>');">
                                    Bearbeiten
                                </button>
                                <button class="editButton" onclick="hideInList('<?= $project["id"] ?>');">Ausblenden
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--  todo ##########  falls man die liste begrenzen will ##########
                          <div class="projectList_ outerTableFooter">
                              <div class="tableFootStyle">
                                  <div class="links">
                                  <a href="#"></a>
                                  <a class="active" href="#">1</a>
                                  <a href="#">2</a>
                                  <a href="#">3</a>
                                  <a href="#">4</a>
                                  <a href="#"></a>
                                  </div>
                              </div>
                          </div>-->
        </div>

        <div style="display:none;background-color: #151313" id="projectDetails" class="w3-modal w3-black">
            <div class="w3-modal-content">
                <div class="w3-content" style="max-width:1200px">
                    <h2 style="margin-bottom: 0;">TITEL</h2>
                    <h3 style="margin-top: 0.5em;"><?= "TITEL"; ?></h3>
                    <div class="projectListContainer container">
                        <div class="projectList_ projectTable">
                            <div class="projectList_ projectTableHeading">
                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">Titel</div>
                                    <input type="text" id="details_title" value="<?= "TITEL"; ?>">
                                </div>
                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">Kategorie</div>
                                    <select name="Kategorie" id="details_category">
                                        <option <?= "Kategorie"; ?> selected="selected" value="null">null</option>
                                        <option <?= "Kategorie"; ?> value="Filmausstattung und Baubühne">Filmausstattung
                                            und Baubühne
                                        </option>
                                        <option <?= "Kategorie"; ?> value="Dekorationsbau">Dekorationsbau</option>
                                        <option <?= "Kategorie"; ?> value="Messebau">Messebau</option>
                                        <option <?= "Kategorie"; ?> value="Theaterkulissen">Theaterkulissen</option>
                                        <option <?= "Kategorie"; ?> value="Promotionausstattung">Promotionausstattung
                                        </option>
                                        <option <?= "Kategorie"; ?> value="Eventausstattung">Eventausstattung</option>
                                    </select>
                                </div>
                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">Datum</div>
                                    <input type="text" id="details_date" value="<?= "DATUM"; ?>">
                                </div>
                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">Info</div>
                                    <div class="fakeTextArea" id="details_info" contenteditable="true" ></div>
                                </div>

                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">Beschreibung</div>
                                    <div class="fakeTextArea" id="details_description" contenteditable="true" ></div>
                                </div>

                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">link</div>
                                    <input type="text" id="details_link" value="<?= "LINK"; ?>">
                                </div>

                                <div class="projectList_ projectTableRow">
                                    <div class="projectList_ projectTableHead">BildPfad</div>
                                    <input type="text" id="details_picturePath" value="<?= "BILDPFAD"; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="details_imgPreview">

                        <!--                        <img id="picID_5" class="details_picPreview"-->
                        <!--                             src="http://localhost/homeofpirates/img/204-vigour_vogue/v01.jpg"-->
                        <!--                             onmouseenter="scalePic(this);" onmouseleave="scalePic(this);">-->


                    </div>
                    <div class="details_imgDropzone">
                        <div id="drop_zone" ondrop="dropHandler()">
                            <h2>IMAGE DROPZONE </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    modalScriptsand Styles start-->
    <style>

        .fakeTextArea {
            width: 100%;
            padding: 1px;
            border: 0;
            overflow: hidden;
            resize: both;
            outline: none;
        }

        .details_picPreview {
            display: flex;
            flex-direction: row;
            text-align: center;
            border-collapse: collapse;
            justify-content: center;
            align-items: center;
            transition: all 1s;

        }

        .details_picPreview.animate {
            width: 500px;
        }


        .details_picPreview {
            border: 5px solid black;
            width: 100px;
        }

        .details_picPreview {
            border: 5px solid black;
            width: 100px;

        }

        #drop_zone {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 5px solid black;
            width: 100%;
            height: 200px;
            background-color: rgba(159, 188, 165, 0.45);
        }

        #drop_zone h2 {
            color: black;
        }

        #searchBar {
            color: black;
        }

        #searchButton {
            color: black;
        }

        .editButton {
            color: black;
        }

        .details_TableRow input, .details_TableRow select {
            background-color: #151313;
            width: 99%;
            text-align: left;
        }


        #details_description {
            text-decoration: none;
            background-color: #151313;
        }

        #details_imgPreview {
            display: flex;
            flex-direction: row;
            text-align: left;
            border-collapse: collapse;
            justify-content: flex-start;
            align-items: center;
        }


        .details_List_.details_TableHead {
            border: 1px solid #AAAAAA;
            padding: 0.5em 1em
        }

        .details_List_.details_TableCell {
            border: 0 solid #AAAAAA;
            padding: 2px 2px;
        }

        .details_List_.details_TableRow:nth-child(even) {
            background: rgb(58, 58, 58);
        }

        .details_List_.details_Table {
            display: flex;
        }

        .details_List_.details_TableRow {
            display: flex;
        }

        .details_List_.details_TableRowSearch {
            display: flex;
        }

        .details_List_.details_TableHeading {
            display: flex;
            width: 100%;
        }

        .details_List_.details_TableHeading {
            display: flex;
        }

    </style>
    <script>
        function textAreaAdjust(element) {
            element.style.height = "1px";
            element.style.height = (25 + element.scrollHeight) + "px";
        }

        function scalePic(element) {
            $(element).toggleClass('animate');
        }

    </script>
    <!--    modalScriptsand Styles end-->

</div>
<style>
    #searchBar {
        color: black;
    }

    #searchButton {
        color: black;
    }

    .editButton {
        color: black;
    }

    div.projectListContainer {
        flex-direction: column;
        text-align: left;
        border-collapse: collapse;
    }

    div.projectList_ {
        border: 1px solid #AAAAAA;
        text-align: left;
        border-collapse: collapse;
    }

    .projectList_.projectTableSearch {
        border: 0px solid #AAAAAA;
        padding: 3px 2px;
        text-align: right;
    }

    .projectList_.projectTableHead {
        border: 1px solid #AAAAAA;
        padding: 3px 2px;
    }

    .projectList_.projectTableCell {
        border: 0 solid #AAAAAA;
        padding: 2px 2px;
    }

    .projectList_.projectTableRow:nth-child(even) {
        background: rgb(58, 58, 58);
    }

    .projectTable.projectList_ .projectList_.projectTableHeading .projectList_.projectTableHead {
        font-weight: normal;
        color: #FFFFFF;
    }

    .projectList_.projectTable {
        display: table;
    }

    .projectList_.projectTableRow {
        display: table-row;
    }

    .projectList_.projectTableRowSearch {
        display: table-row;
    }

    .projectList_.projectTableHeading {
        display: table-header-group;
    }

    .projectList_.projectTableCell, .projectList_.projectTableHead, .projectList_.projectTableSearch {
        display: table-cell;
    }

    .projectList_.projectTableHeading {
        display: table-header-group;
    }


    /*table footer*/
    .projectTableBody {
        display: table-row-group;
    }

    .projectList_.outerTableFooter {
        border-top: none;
    }

    .projectList_.projectTableFoot {
        display: table-footer-group;
    }

    .projectList_.outerTableFooter .tableFootStyle {
        padding: 3px 5px;
    }

    .projectList_.tableFootStyle .links a {
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 8px;
        border-radius: 5px;
    }

</style>
<script>


    function setActiveProject(projectId) {
        $('#selectedID').val(projectId);
    }

    function hideInList(projectId) {
        $('#row_' + projectId).remove();
    }

    function showDetailsWindow(id) {
        setActiveProject(id);
        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "getProject",
                ctrl: "Admin/Admin_Projects",
                projectId: $('#selectedID').val(),
            },
            success: function (response) {
                var object = JSON.parse(response);

                var img = ""
                $.each(object["aImgPaths"], function (index, value) {
                    img = img + '<img id="picID_' + index + '" class="details_picPreview" src="' + value + '" onmouseenter="scalePic(this);" onmouseleave="scalePic(this);">';
                });
                $("#details_imgPreview").html(img);
                $("#details_picturePath").val(object["bildpfad"]);
                $("#details_link").val(object["link"]);
                $("#details_description").html(object["beschreibung"]);
                $("#details_info").html(object["info"]);
                $("#details_date").val(object["datum"]);
                $("#details_title").val(object["titel"]);
                $("#details_category").val(object["kategorie"]);

                $("#projectDetails").modal();
            }

        });
    }

    // function getOrder(orderBy){
    //     if (!$(element).data('clicked')) {
    //         $(element).data('clicked', true);
    //     }
    //
    // }

    function getList() {
        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "loadProjects",
                ctrl: "Admin/Admin_Projects",
                searchTerm: $('#searchBar').val(),
            },
            success: function (response) {
                var elemtentArray = JSON.parse(response);
                console.log(elemtentArray);
                var list = "";
                $.each(elemtentArray, function (index, value) {
                    list = list +
                        '<div id="row_' + value["id"] + '" class="projectList_ projectTableRow">' +
                        '<div class="projectList_ projectTableCell">' + value["title"] + '</div>' +
                        '<div class="projectList_ projectTableCell">' + value["category"] + '</div>' +
                        '<div class="projectList_ projectTableCell">' + ((value["date"] != null) ? value["date"] : "") + '</div>' +
                        '<div class="projectList_ projectTableCell">' +
                        '<button class="editButton" onclick="showDetailsWindow(\'' + value["id"] + '\');">Bearbeiten</button>\n' +
                        '<button class="editButton" onclick="hideInList(\'' + value["id"] + '\');">Ausblenden</button>' +
                        '</div>' +
                        '</div>';

                });
                $("#projects_List").html(list);
            }
        });
    }

    function dropHandler() {
        console.log("drops");
    }
</script>