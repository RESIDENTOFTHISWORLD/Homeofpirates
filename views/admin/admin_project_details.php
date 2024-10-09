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
                            <input class="details_TableCell" id="details_picturePathOld" value="">
                            <input class="details_TableCell required" id="details_picturePath" name="projectData[bildpfad]" value="">
                            <!--todo PATH NEED DIFFERENT UPDATE-->
                            <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="updatePath();">update</div>
                        </div>
                        <div class="details_TableRow details_picturePathNew">
                            <div class="details_TableCell details_TableHead">BildPfadNeu</div>
                            <input class="details_TableCell required" id="details_picturePathNew" value="">

                            <div class="details_TableCell details_UpdateButton showOnUpdate" onclick="setNewPath();">SetNew</div>
                            <!--TODO last THing before basically fully functional MAKE DIrectory AND SET DIRECTORY in one go-->
                        </div>
                    </div>
                </div>
            </div>

            <div id="errorPathOld" style=" text-align: center; width:100%; display:none; background-color:firebrick;padding: 1em">
                Path Does not exists yet </br>
                set new Path
            </div>
            <div id="errorPathSet" style=" text-align: center; width:100%; display:none; background-color:firebrick;padding: 1em">
            </div>

            <!--PicturePreviewSection-->
            <div class="showOnUpdate showOnCopy" id="details_imgPreview">
            </div>

            <!--PictureUploadSection-->
            <div class="showOnUpdate" id="details_imgDropzone">
                <div id="drop_zone">
                    <h2>IMAGE DROPZONE </h2>
                </div>
            </div>
            <!--SAVE BUTTONS-->
            <button class="showOnUpdate" id="details_UpdateALLButton" onclick="updateAll();">Update ALL</button>
            <button class="showOnCreate" id="details_UpdateALLButton" onclick="createNew();">Create Project</button>
            <button class="showOnCopy"   id="details_UpdateALLButton" onclick="createNew();">Create Copy of Project</button>
        </div>
    </div>
</div>
<!--end MODAL FOR EDITING EACH PROJECT-->

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
    //FILE UPLOAD Functions
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
        reloadDetailsWindow();
    }

    //STYLE UPDATES FOR MISC.
    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25 + element.scrollHeight) + "px";
    }

    function scalePic(element) {
        $(element).toggleClass('animate');
    }

    //UPDATE SINGLE VALUES
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
        reloadDetailsWindow();
    }

    function setNewPath() {
        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "setNewPath",
                ctrl: "Admin/Admin_Projects",
                id: getActiveProject(),
                value: $('#details_picturePathNew').val(),
            },
            success: function (response) {
                if (response === "created"){
                    reloadDetailsWindow();
                }else if (response === "exists") {
                    $('#errorPathSet').html("Directory already exists");
                    $(".details_picturePathNew").css("display", "table-row");
                    $("#errorPathSet").show();

                } else if (response === "invalid") {
                    $('#errorPathSet').html("Something during creation of folder went wrong </br>" +
                        "(Server might not have access or invalid characters used)");
                    $(".details_picturePathNew").css("display", "table-row");
                    $("#errorPathSet").show();
                }
            }
        });

    }

    function updatePath() {
        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "updateValue",
                ctrl: "Admin/Admin_Projects",
                id: getActiveProject(),
                column: "bildPfad",
                value: $('#details_picturePath').val(),
            },
            success: function (response) {
                reloadDetailsWindow();
            }
        });
    }

    function updateFakeTextBoxval() {
        $("#details_infoHidden").val($("#details_info").html());
        $("#details_descriptionHidden").val($("#details_description").html());
    }

    //UPDATE ALL VALUES
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
        reloadDetailsWindow();
    }

    //CREATE NEW PROJECT
    function createNew() {
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
                reloadDetailsWindow();
            }
        });
    }


    //TODO ARCHIVE PROJECT
    function archiveProject() {
        console.log("Archive");
    }

    //RELOADS ONLY DETAILS WINDOW WHEN UPDATED/NEWLY CREATED/COPIED
    function reloadDetailsWindow() {
        var id = getActiveProject();
        showEdit(id);
    }
</script>
<!--end modal Scripts and Styles-->