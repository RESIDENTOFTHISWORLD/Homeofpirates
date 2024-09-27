<div class='main'>
    <input type="hidden" id="selectedID" name="projectData[id]" value="">
    <div id="AdminProjectsContainer" class="content">
        <div class="container">
            <h1>Admin Projekte</h1>
        </div>
        <div class="container">
            <span>ProjectsEditor</span>
        </div>
        <!--        start PROJECT LIST WITH SORTING-->
        <div class="projectListContainer container">
            <div class="projectList_ projectTable">
                <div class="projectList_ projectTableHeading">
                    <div class="projectList_ projectTableRowHeader">
                        <div class="projectList_ projectTableHeader">
                            <button id="createButton" onclick="createNewProject()">Neues Project</button>
<!-- todo create COPY of selected project                            <button id="createButton" onclick="createNewProject()">Neues Project</button>-->
                        </div>
                        <div class="projectList_ projectTableHeader">
                        </div>
                        <div class="projectList_ projectTableHeader"></div>
                        <div class="projectList_ projectTableHeader searchAlign">
                            <button id="createButton" onclick="showDetailsWindow()">Fenster Öffnen</button>
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
        <!--        end PROJECT LIST WITH SORTING-->

        <!--        start MODAL FOR EDITING EACH PROJECT-->
        <div style="display:none;background-color: #151313" id="projectDetails" class="w3-modal w3-black">
            <div class="w3-modal-content">
                <div class="w3-content" style="max-width:1200px">
                    <h2 style="margin-bottom: 0;">TITEL</h2>
                    <h3 id="details_titleText" style="margin-top: 0.5em;"></h3>
                    <div class="details_Container">
                        <div class="details_Table">
                            <div class="details_TableHeadings">
                                <div class="details_TableRow">
                                    <div class="details_TableCell details_TableHead">Titel</div>
                                    <input class="details_TableCell" id="details_title" name="projectData[titel]" value="">

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_title'));">update</div>
                                </div>
                                <div class="details_TableRow">
                                    <div class="details_TableCell details_TableHead">Kategorie</div>
                                    <select class="details_TableCell" id="details_category" name="projectData[kategorie]">
                                        <option selected="selected" value="null">null</option>
                                        <option value="Filmausstattung und Baubühne">Filmausstattung und Baubühne</option>
                                        <option value="Dekorationsbau">Dekorationsbau</option>
                                        <option value="Messebau">Messebau</option>
                                        <option value="Theaterkulissen">Theaterkulissen</option>
                                        <option value="Promotionausstattung">Promotionausstattung</option>
                                        <option value="Eventausstattung">Eventausstattung</option>
                                    </select>

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_category'));">update</div>
                                </div>
                                <div class="details_TableRow">
                                    <div class="details_TableCell details_TableHead">Datum</div>
                                    <input class="details_TableCell" id="details_date" name="projectData[datum]" value="">

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_date'));">update</div>
                                </div>
                                <div class="details_TableRow">
                                    <div class="details_TableCell details_TableHead">Info</div>
                                    <div class="details_TableCell" id="details_info" contenteditable="true"></div>
                                    <input hidden="hidden" id="details_infoHidden" name="projectData[info]" value="">

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_info'));">update</div>
                                </div>
                                <div class="details_TableRow">
                                    <div class="details_TableCell details_TableHead">Beschreibung</div>
                                    <div class="details_TableCell" id="details_description" contenteditable="true"></div>
                                    <input hidden="hidden" id="details_descriptionHidden" name="projectData[beschreibung]" value="">

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_description'));">update</div>
                                </div>
                                <div class="details_TableRow">
                                    <div class="details_TableCell details_TableHead">link</div>
                                    <input class="details_TableCell" id="details_link" name="projectData[link]" value="">

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_link'));">update</div>
                                </div>
                                <div class="details_TableRow details_picturePath">
                                    <div class="details_TableCell details_TableHead">BildPfad</div>
                                    <input class="details_TableCell" id="details_picturePathOld"  value="">
                                    <input class="details_TableCell required" id="details_picturePath" name="projectData[bildpfad]" value="">
                                    <!--                                    todo PATH NEED DIFFERENT UPDATE-->

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_picturePath'));">update</div>
                                </div>
                                <div class="details_TableRow details_picturePathNew">
                                    <div class="details_TableCell details_TableHead">BildPfadNeu</div>
                                    <input class="details_TableCell required" id="details_picturePathNew"  value="">

                                    <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updateValue($('#details_picturePathNew'));">SetNew</div>
<!--                                    TODO last THing before basically fully functional  MAKE DIrectory AND SET DIRECTORY in one go-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="errorPathOld" style=" text-align: center; width:100%; display:none; background-color:firebrick;padding: 1em">
                        Path Does not exists yet </br>
                        set new Path
                    </div>

                    <!--PicturePreviewSection-->
                    <div class="showOnUpdate" id="details_imgPreview">
                </div>

                <!--PictureUploadSection-->
                <div class="showOnUpdate" id="details_imgDropzone">
                <div id="drop_zone">
                    <h2>IMAGE DROPZONE </h2>
                </div>
            </div>
            <button class="showOnUpdate" id="details_UpdateALLButton" onclick="updateAll();">update ALL</button>
            <button class="showOnCreate" id="details_UpdateALLButton" onclick="createFromAll();">Create Project</button>
        </div>
    </div>
</div>
<!--end MODAL FOR EDITING EACH PROJECT-->
</div>
<!--start modal Scripts and Styles -->
<style>
    .details_Container {
        text-align: left;
        font-size: 1em;
        margin-bottom: 2em;
    }

    .details_Table {
        display: table;
    }

    .details_TableHeadings {
        display: table-header-group;
    }

    .details_TableColumn {
        display: table-column-group;
    }

    .details_TableRow {
        display: table-row;
        width: 100%;
    }

    .details_TableHead {
        display: table-column;
        border: 1px solid #AAAAAA;
        padding: 0.5em 1em
    }

    .details_TableCell {
        display: table-cell;
    }

    .details_TableRow input,
    .details_TableRow select,
    .details_UpdateButton,
    #details_UpdateALLButton,
    #details_description {
        font-size: 1em;
        border: 1px solid #AAAAAA;
        padding: 0.5em 1em;
        background-color: #151313;
        width: 100%;
        text-align: left;
    }

    /*.details_UpdateButton {*/
    /*}*/
    #details_UpdateALLButton {
        font-weight: bold;
        font-size: 2em;
        text-align: center;
        margin-top: 2em;
    }

    .details_UpdateButton:hover,
    #details_UpdateALLButton:hover {
        cursor: pointer;
        background-color: #4f4747;
    }

    .details_UpdateButton:active,
    #details_UpdateALLButton:active {
        background-color: #232020;
    }

    #details_description,
    #details_info {
        overflow: hidden;
        padding: 0;
        outline: none;
        border: 1px solid #AAAAAA;
    }

    /*PicturePreviewSection*/
    #details_imgPreview {
        display: flex;
        flex-direction: row;
        text-align: left;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 2em;
    }

    .details_imgPreviewPic {
        display: flex;
        flex-direction: row;
        text-align: center;
        justify-content: center;
        align-items: center;
        transition: all 1s;
        border: 5px solid black;
        width: 100px;
    }

    .details_imgPreviewPic.animate {
        /*todo muss angepasst werden damit es gut aussieht*/
        width: 50%;
    }

    /*PictureUploadSection*/
    #drop_zone {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 5px solid black;
        width: 100%;
        height: 150px;
        background-color: rgba(159, 188, 165, 0.45);
    }

    #drop_zone h2 {
        color: black;
    }

    .details_picturePathNew,
    #details_picturePathOld {
        display: none;
    }
</style>
<script>
    $('#drop_zone').on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });
    $('#drop_zone').on('dragenter', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });
    $('#drop_zone').on('drop', function (e) {
        if (e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
            e.preventDefault();
            e.stopPropagation();
            if ($("#details_picturePath").val() === "" && $("#details_picturePath").val() == null) {
                return false;
            }

            uploadFiles(e.originalEvent.dataTransfer.files);
        }
    });

    function uploadFiles(files) {
        var formData = new FormData();
        formData.append("actn", "uploadFiles");
        formData.append("ctrl", "Admin/Admin_Projects");
        formData.append("picturePath", $('#details_picturePath').val());

        $.each(files, function (index, value) {
            if (value.type.indexOf('image/') !== 0) {
                $("#details_imgDropzone").prepend('<div class="errorContainer" style="background-color:firebrick; margin-top:3px; padding: 1em">' +
                    '<h2 class="errorMessage">' + value.name + ' is not a valid Image </h2>' +
                    '</div>');
                $(".errorContainer").delay(2000).fadeOut(3000, function () {
                    this.remove()
                });
            } else {
                formData.append('file_' + index, value);
            }
        });

        $.ajax({
            url: "",
            cache: false,
            processData: false,
            contentType: false,
            type: "post",
            data: formData,
            success: function (response) {

            }
        });
        showDetailsWindow(getActiveProject());
    }

    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25 + element.scrollHeight) + "px";
    }

    function scalePic(element) {
        $(element).toggleClass('animate');
    }

    function updateValue(element, type) {
        updateFakeTextBoxval();

        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "updateValue",
                ctrl: "Admin/Admin_Projects",
                id: getActiveProject(),
                column: type,
                value: $(element).val(),
            },
            success: function (response) {
                setActiveProject()
                console.log(response);
            }
        });
        showDetailsWindow(getActiveProject());
    }

    function updateFakeTextBoxval(){
        $("#details_infoHidden").val($("#details_info").html());
        $("#details_descriptionHidden").val($("#details_description").html());
    }

    function updateAll() {

        updateFakeTextBoxval();
        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "save",
                ctrl: "Admin/Admin_Projects",
                projectData: $('[name^="projectData"]').serializeArray(),
            },
            success: function (response) {
                console.log(response);
            }
        });
    }

    function createFromAll() {
        updateFakeTextBoxval();

        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "save",
                ctrl: "Admin/Admin_Projects",
                projectData: $('[name^="projectData"]').serializeArray(),
            },
            success: function (response) {
                setActiveProject(response)
                showDetailsWindow(getActiveProject());
            }
        });
    }

    function archiveProject() {
        console.log("Archive");
    }

</script>
<!--end modal Scripts and Styles-->

</div>
<style>

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

    function getActiveProject(){
        return $('#selectedID').val();
    }

    function setActiveProject(projectId = null) {
        $('#selectedID').val(projectId);
    }

    function hideInList(projectId) {
        $('#row_' + projectId).remove();
    }

    function createNewProject() {
        setActiveProject();
        showDetailsWindow();

    }
    function createCopyFromProject() {
        showDetailsWindow();
    }

    function showDetailsWindow(id = null) {
        if (id == null) {
            $(".details_UpdateButton").css("display","none");
            $(".showOnUpdate").attr("hidden","undefined");
            $(".showOnCreate").removeAttr("hidden");
            $("#projectDetails").modal();
        } else {
            $(".details_UpdateButton").css("display","table-cell");
            $(".showOnCreate").attr("hidden","undefined");
            $(".showOnUpdate").removeAttr("hidden");
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

                    $("#details_titleText").html(object["titel"]).text();
                    $("#details_title").val(object["titel"]).text();
                    $("#details_category").val(object["kategorie"]).text();
                    $("#details_date").val(object["datum"]).text();

                    $("#details_description").html(object["beschreibung"]).text();
                    $("#details_info").html(object["info"]).text();

                    $("#details_link").val(object["link"]).text();


                    $("#details_picturePath").val(object["bildpfad"]).text();
                    if (!object["bildpfadOld"] == "") {

                        $(".details_picturePathNew").css("display", "table-row");
                        $("#errorPathOld").show();
                    } else {
                        $(".details_picturePathNew").hide();
                        $("#errorPathOld").hide();
                    }
                    $("#details_picturePathOld").val(object["bildpfadOld"]).text();

                    var img = ""
                    $.each(object["aImgPaths"], function (index, value) {
                        img = img + '<img id="picID_' + index + '" class="details_imgPreviewPic" src="' + value + '" onmouseenter="scalePic(this);" onmouseleave="scalePic(this);">';
                    });
                    $("#details_imgPreview").html(img);

                    $("#projectDetails").modal();
                }
            });
        }
    }
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
                        '<button class="editButton" onclick="showDetailsWindow(\'' + value["id"] + '\');">Bearbeiten</button>\n' +
                        '<button class="editButton" onclick="hideInList(\'' + value["id"] + '\');">Ausblenden</button>' +
                        '</div>' +
                        '</div>';

                });
                $("#projects_List").html(list);
            }
        });
    }
</script>