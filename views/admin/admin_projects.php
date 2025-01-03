<div class='main'>
    <input type="hidden" id="selectedID" name="projectData[id]" value="">
    <div id="AdminProjectsContainer" class="content">
        <div class="container">
            <h1>Admin Projekte</h1>
        </div>
        <div class="container">
            <span>ProjectsEditor</span>
        </div>
        <!--start PROJECT LIST WITH SORTING-->
        <div class="projectListContainer container">
            <div class="projectList_ projectTable">
                <div class="projectList_ projectTableHeading">
                    <div class="projectList_ projectTableRowHeader">
                        <div class="projectList_ projectTableHeader">
                            <button id="createButton" onclick="createNewProject()">Neues Projekt</button>
                            <button id="createButton" class="showIfProjectSelected" onclick="createNewCopy()">Neue Kopie</button>
                        </div>
                        <div class="projectList_ projectTableHeader">
                        </div>
                        <div class="projectList_ projectTableHeader"></div>
                        <div class="projectList_ projectTableHeader searchAlign">
                            <button id="createButton" class="showOpenButton" onclick="showDetails()">Fenster Öffnen</button>
                            <input id="searchBar" placeholder="suchbegriff" value="">
                            <button id="searchButton" onclick="getList()">Suchen</button>
                        </div>
                    </div>
                    <div class="projectList_ projectTableRow">
                        <!--todo ORDER BY different COllums                  <div class="projectList_ projectTableHead"><button id="searchButton" onclick="getOrder("title")">Titel</button></div>-->
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
                                <button class="editButton" onclick="showEdit('<?= $project["id"] ?>');">
                                    Bearbeiten
                                </button>
                                <button class="editButton" onclick="hideInList('<?= $project["id"] ?>');">Ausblenden
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--todo ##########  falls man die liste begrenzen will ##########-->
            <!--                          <div class="projectList_ outerTableFooter">-->
            <!--                              <div class="tableFootStyle">-->
            <!--                                  <div class="links">-->
            <!--                                  <a href="#"></a>-->
            <!--                                  <a class="active" href="#">1</a>-->
            <!--                                  <a href="#">2</a>-->
            <!--                                  <a href="#">3</a>-->
            <!--                                  <a href="#">4</a>-->
            <!--                                  <a href="#"></a>-->
            <!--                                  </div>-->
            <!--                              </div>-->
            <!--                          </div>-->
        </div>
        <!--end PROJECT LIST WITH SORTING-->

        <!--start INCLUDE DETAILS VIEW -->
        <?php include $config->getProjectPath() . "views/admin/admin_project_details.php"; ?>
        <!--end INCLUDE DETAILS VIEW -->
    </div>
</div>
<style>

    .showIfProjectSelected,
    .showOpenButton{
        display: none;
    }

    .editButton,
    #searchButton,
    #createButton,
    #searchBar {
        font-size: 1em;
        border: 1px solid #AAAAAA;
        background-color: #151313;
    }

    .projectTableHeader.searchAlign {
        text-align: right;
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

    .projectList_.projectTableHeader {
        font-size: 2em;
        border: 0px solid #AAAAAA;
        padding: 3px 2px;
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

    .projectList_.projectTableRowHeader {
        display: table-row;
    }

    .projectList_.projectTableHeading {
        display: table-header-group;
    }

    .projectList_.projectTableCell, .projectList_.projectTableHead, .projectList_.projectTableHeader {
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

    //GETTER AND SETTER FOR PROJEKT
    function getActiveProject() {
        return $('#selectedID').val();
    }
    function setActiveProject(projectId = null) {
        $('#selectedID').val(projectId);
        onIdChange(projectId);
    }

    //CHANGES VIEW ON PROJECT SELECTION
    function onIdChange(projectId){
        $('.showOpenButton').css("display","inline-block");
        if(projectId == null){
            $('.showIfProjectSelected').hide();
        }else{
            $('.showIfProjectSelected').css("display","inline-block");
        }
    }
    //SETS DETAILS VIEW MODE
    function showEdit (id) {
        showDetails(id,"Update",true);
    }
    function createNewProject() {
        setActiveProject();
        clearDetails();
        showDetails(null,"Create", true);
    }
    function createNewCopy() {
        showDetails(null,"Copy",true);
        setActiveProject();
    }
    function showDetails(id = null, mode = "", hideElements = false) {
        if(hideElements){
            $('.showOnUpdate').hide();
            $('.showOnCreate').hide();
            $('.showOnCopy').hide();
        }
        if(mode !== "") {
            $('.showOn'+mode).show();
        }
        if (id === null) {
            $("#projectDetails").modal();
        } else if(id !== null){
            setActiveProject(id);
            clearDetails();
            openDetailsWindow();
        }
    }

    //OPENS DETAIL VIEW
    function openDetailsWindow() {
        //LOADING SPECIFIC PROJECT INTO DETAIL WINDOW
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
                //FILLING FIELDS IN DETAIL WINDOW
                $("#details_titleText").html(object["titel"]).text();
                $("#details_title").val(object["titel"]).text();
                $("#details_category").val(object["kategorie"]).text();
                $("#details_date").val(object["datum"]).text();
                $("#details_description").html(object["beschreibung"]).text();
                $("#details_info").html(object["info"]).text();
                $("#details_link").val(object["link"]).text();
                $("#details_picturePath").val(object["bildpfad"]).text();
                //sozial list
                if (!object["sozials"] == "") {
                    var links = "";
                    $.each(object["sozials"], function (index, value) {
                        links = links +
                            '<div style="flex-direction:column">' +
                            '<a type_href="'+value["url"]+'">' +
                            '<img class="details_sozialPreviewPic"  src="http://<?=$config->domain;?>/img/sozials/' + value["type"] + '_sozial.png">' +
                            '</a>'+
                            '<span class="details_TableCell" id="details_sozialLinkNew" value="">'+ value["url"] + '</span>'+
                            '</div>';
                    });
                    $("#details_sozialPreview").html(links);
                }
                //IMG PATH CHECK
                if (!object["bildpfadOld"] == "") {
                    $(".details_picturePathNew").css("display", "table-row");
                    $("#errorPathOld").show();
                } else {
                    $(".details_picturePathNew").hide();
                    $("#errorPathOld").hide();
                    $("#errorPathSet").hide();
                }
                $("#details_picturePathOld").val(object["bildpfadOld"]).text();

                //LOADING IMAGES INTO PREVIEW
                var img = ""
                $.each(object["aImgPaths"], function (index, value) {
                    img = img + '<div style="flex-direction:column">' +
                        '<img id="picID_' + index + '" class="details_imgPreviewPic"  src="' + value + '" onmouseenter="scalePic(this);" onmouseleave="scalePic(this);">' +
                        '<button class="details_imgPreviewPic" style="background-image:url(\'http://<?=$config->domain;?>/img/icons/xCloseIcon.png\')">' +
                        '</div>';
                });
                $("#details_imgPreview").html(img);

                $("#projectDetails").modal();
            }
        });
    }

    //CLEARS DETAILS WINDOW FOR FRESH CREATION OF PROJECT
    function clearDetails() {
        $("#details_titleText").html("").text();
        $("#details_title").val("").text();
        $("#details_category").val("").text();
        $("#details_date").val("").text();
        $("#details_description").html("").text();
        $("#details_info").html("").text();
        $("#details_link").val("").text();
        $("#details_picturePath").val("").text();
        $("#details_picturePathOld").val("").text();
        $("#details_picturePathNew").val("").text();
        $("#details_imgPreview").html("");
        $("#details_sozialPreview").html("");
        $("#details_sozialLinkNew").val("").text();
        $("#details_sozialType").val("").text();     //todo set to null somehow
    }

    //LOADS IN THE BIG LIST
    function getList() {
        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "loadProjects",
                ctrl: "Admin/Admin_Projects",
                searchTerm: $('#searchBar').val(),
                //     TODO SORTING ODER ASC DESC etc....
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
                        '<button class="editButton" onclick="showEdit(\'' + value["id"] + '\');">Bearbeiten</button>\n' +
                        '<button class="editButton" onclick="hideInList(\'' + value["id"] + '\');">Ausblenden</button>' +
                        '</div>' +
                        '</div>';

                });
                $("#projects_List").html(list);
            }
        });
    }

    //HIDES PROJECTS IN LIST
    function hideInList(projectId) {
        $('#row_' + projectId).remove();
    }

</script>