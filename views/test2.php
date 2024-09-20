<!--<div style="background-color: #151313" id="projectDetails" class="w3-modal w3-black">-->
<!--    <div class="w3-modal-content">-->
<!--        <div class="w3-content" style="max-width:1200px">-->
<!--            <h2 style="margin-bottom: 0;">TITEL</h2>-->
<!--            <h3 style="margin-top: 0.5em;">--><?php //= "TITEL"; ?><!--</h3>-->
<!--            <div class="projectListContainer container">-->
<!--                <div class="projectList_ projectTable">-->
<!--                    <div class="projectList_ projectTableHeading">-->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">Titel</div>-->
<!--                            <input type="text" id="details_title" value="--><?php //= "TITEL"; ?><!--">-->
<!--                        </div>-->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">Kategorie</div>-->
<!--                            <select name="Kategorie" id="details_category">-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- selected="selected" value="null">null</option>-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- value="Filmausstattung und Baubühne">Filmausstattung und Baubühne</option>-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- value="Dekorationsbau">Dekorationsbau</option>-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- value="Messebau">Messebau</option>-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- value="Theaterkulissen">Theaterkulissen</option>-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- value="Promotionausstattung">Promotionausstattung</option>-->
<!--                                <option --><?php //= "Kategorie"; ?><!-- value="Eventausstattung">Eventausstattung</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">Datum</div>-->
<!--                            <input type="text" id="details_date" value="--><?php //= "DATUM"; ?><!--">-->
<!--                        </div>-->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">Info</div>-->
<!--                            <textarea id="details_info">--><?php //= "INFO"; ?><!--</textarea>-->
<!--                        </div>-->
<!---->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">Beschreibung</div>-->
<!--                            <input type="text" id="details_description" value="--><?php //= "BESCHREIBUNG"; ?><!--">-->
<!--                        </div>-->
<!---->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">link</div>-->
<!--                            <input type="text" id="details_link" value="--><?php //= "LINK"; ?><!--">-->
<!--                        </div>-->
<!---->
<!--                        <div class="projectList_ projectTableRow">-->
<!--                            <div class="projectList_ projectTableHead">BildPfad</div>-->
<!--                            <input type="text" id="details_picturePath" value="--><?php //= "BILDPFAD"; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <img id="picID_1" class="details_picPreview" src="http://localhost/homeofpirates/img/204-vigour_vogue/v01.jpg">-->
<!---->
<!--<!--                -->--><?php ////$aPreviews = $controller->getImgPreviews();
////                foreach ($aPreviews as $aPreview){ ?>
<!--<!--                <img src="http://-->--><?php ////=$config->domain.'/'.$aPreview ?><!--<!--">-->-->
<!--<!--                -->--><?php ////} ?>
<!--            </div>-->
<!--            <div class="details_imgPreview">-->
<!--                <div id="drop_zone" ondrop="dropHandler(event);">-->
<!--                    <p>Drag one or more files to this <i>drop zone</i>.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--<style>-->
<!---->
<!--    .details_picPreview {-->
<!--        border: 5px solid black;-->
<!--        width: 100px;-->
<!---->
<!--    }-->
<!---->
<!--    .details_picPreview {-->
<!--        border: 5px solid black;-->
<!--        width: 100px;-->
<!---->
<!--    }-->
<!--    #drop_zone {-->
<!--        border: 5px solid black;-->
<!--        width: 200px;-->
<!--        height: 100px;-->
<!--    }-->
<!---->
<!--    #searchBar {-->
<!--        color: black;-->
<!--    }-->
<!---->
<!--    #searchButton {-->
<!--        color: black;-->
<!--    }-->
<!---->
<!--    .editButton {-->
<!--        color: black;-->
<!--    }-->
<!---->
<!--    .projectTableRow input, .projectTableRow textarea, .projectTableRow select{-->
<!--        width: 100%;-->
<!--        text-align: left;-->
<!--    }-->
<!---->
<!--    div.projectListContainer {-->
<!--        flex-direction: column;-->
<!--        text-align: left;-->
<!--        border-collapse: collapse;-->
<!--    }-->
<!---->
<!--    div.projectList_ {-->
<!--        border: 1px solid #AAAAAA;-->
<!--        text-align: left;-->
<!--        border-collapse: collapse;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableHead {-->
<!--        border: 1px solid #AAAAAA;-->
<!--        padding: 0.5em 1em-->
<!---->
<!--    }-->
<!---->
<!--    .projectList_.projectTableCell {-->
<!--        border: 0 solid #AAAAAA;-->
<!--        padding: 2px 2px;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableRow:nth-child(even) {-->
<!--        background: rgb(58, 58, 58);-->
<!--    }-->
<!---->
<!--    .projectTable.projectList_ .projectList_.projectTableHeading .projectList_.projectTableHead {-->
<!--        font-weight: normal;-->
<!--        color: #FFFFFF;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTable {-->
<!--        display: flex;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableRow {-->
<!--        display: flex;-->
<!--        justify-content: space-between;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableRowSearch {-->
<!--        display: flex;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableHeading {-->
<!--        display: flex;-->
<!--        width: 100%;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableCell, .projectList_.projectTableHead, .projectList_.projectTableSearch {-->
<!--        display: flex;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableHeading {-->
<!--        display: flex;-->
<!--        flex-direction: column;-->
<!---->
<!--    }-->
<!---->
<!---->
<!--    /*table footer*/-->
<!--    .projectTableBody {-->
<!--        display: flex;-->
<!--    }-->
<!---->
<!--    .projectList_.outerTableFooter {-->
<!--        border-top: none;-->
<!--    }-->
<!---->
<!--    .projectList_.projectTableFoot {-->
<!--        display: table-footer-group;-->
<!--    }-->
<!---->
<!--    .projectList_.outerTableFooter .tableFootStyle {-->
<!--        padding: 3px 5px;-->
<!--    }-->
<!---->
<!--    .projectList_.tableFootStyle .links a {-->
<!--        display: inline-block;-->
<!--        background: #1C6EA4;-->
<!--        color: #FFFFFF;-->
<!--        padding: 2px 8px;-->
<!--        border-radius: 5px;-->
<!--    }-->
<!---->
<!--</style>-->
<!--<script>-->
<!---->
<!---->
<!---->
<!--    $('.details_picPreview').hover(function() {-->
<!--        $('.picID_1 .details_picPreview').toggleClass('animate');-->
<!--    })-->
<!---->
<!--</script>-->
<!--<style>-->
<!--    .details_picPreview {-->
<!--        transform: scale(0);-->
<!--        width: 100px;-->
<!--        transition: all 1s;-->
<!--    }-->
<!---->
<!--    .details_picPreview.animate {-->
<!--        transform: scale(1);-->
<!--    }-->
<!--</style>-->