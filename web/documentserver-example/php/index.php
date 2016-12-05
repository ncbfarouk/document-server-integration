<?php
/*
 *
 * (c) Copyright Ascensio System Limited 2010-2016
 *
 * This program is freeware. You can redistribute it and/or modify it under the terms of the GNU 
 * General Public License (GPL) version 3 as published by the Free Software Foundation (https://www.gnu.org/copyleft/gpl.html). 
 * In accordance with Section 7(a) of the GNU GPL its Section 15 shall be amended to the effect that 
 * Ascensio System SIA expressly excludes the warranty of non-infringement of any third-party rights.
 *
 * THIS PROGRAM IS DISTRIBUTED WITHOUT ANY WARRANTY; WITHOUT EVEN THE IMPLIED WARRANTY OF MERCHANTABILITY OR
 * FITNESS FOR A PARTICULAR PURPOSE. For more details, see GNU GPL at https://www.gnu.org/copyleft/gpl.html
 *
 * You can contact Ascensio System SIA by email at sales@onlyoffice.com
 *
 * The interactive user interfaces in modified source and object code versions of ONLYOFFICE must display 
 * Appropriate Legal Notices, as required under Section 5 of the GNU GPL version 3.
 *
 * Pursuant to Section 7 § 3(b) of the GNU GPL you must retain the original ONLYOFFICE logo which contains 
 * relevant author attributions when distributing the software. If the display of the logo in its graphic 
 * form is not reasonably feasible for technical reasons, you must include the words "Powered by ONLYOFFICE" 
 * in every copy of the program you distribute. 
 * Pursuant to Section 7 § 3(e) we decline to grant you any rights under trademark law for use of our trademarks.
 *
*/
?>

<?php
    require_once( dirname(__FILE__) . '/config.php' );
    require_once( dirname(__FILE__) . '/common.php' );
    require_once( dirname(__FILE__) . '/functions.php' );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ONLYOFFICE Integration Edition</title>

        <link rel="icon" href="./favicon.ico" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:900,800,700,600,500,400,300&subset=latin,cyrillic-ext,cyrillic,latin-ext" />

        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>

        <script type="text/javascript" src="js/jquery-ui.min.js"></script>

        <script type="text/javascript" src="js/jquery.blockUI.js"></script>

        <script type="text/javascript" src="js/jquery.iframe-transport.js"></script>

        <script type="text/javascript" src="js/jquery.fileupload.js"></script>

        <script type="text/javascript" src="js/jquery.dropdownToggle.js"></script>

        <script type="text/javascript" src="js/jscript.js"></script>

        <script type="text/javascript">
            var ConverExtList = '<?php echo implode(",", $GLOBALS["DOC_SERV_CONVERT"]) ?>';
            var EditedExtList = '<?php echo implode(",", $GLOBALS["DOC_SERV_EDITED"]) ?>';
        </script>
    </head>
    <body>
        <form id="form1">
        <header>
            <a href="/">
                <img src ="css/images/logo.png" alt="ONLYOFFICE" />
            </a>
        </header>
        <div class="main-panel">
            <span class="portal-name">ONLYOFFICE Integration Edition – Welcome!</span>
            <br />
            <br />
            <span class="portal-descr">This interactive example demonstrates a way to integrate ONLYOFFICE™ collaborative online document editing into your Web Application. Our editors are fully implemented in HTML5! You may upload your own documents for testing, using the "Upload file" button and uploading local Office files from your computer. You can upload the documents with the most popular file formats, such as .DOCX, .XLSX, .PPTX, etc.</span>
            <ul class="features-list">
                <li>Open, Edit and Save existing documents for in-browser editing using ONLYOFFICE™ Server documents.</li>
                <li>Collaborative co-editing functions – chat, comments and other multi-user features.</li>
                <li>Use of Auto-save function.</li>
                <li>All editing operations are processed on this virtual machine. Your documents stay under your complete control.</li>
            </ul>

            <div class="file-upload button gray">
                <span>Choose file</span>
                <input type="file" id="fileupload" name="files" data-url="webeditor-ajax.php?type=upload" />
            </div>
            <label class="save-original">
                <input type="checkbox" id="checkOriginalFormat" class="checkbox" />Save document in original format
            </label>
            <span class="question"></span>
            <br />
            <br />
            <br />
            <span class="try-descr">Or, you can view and edit sample documents – click on one of the links below.</span>

            <ul class="try-editor-list">
                <li><a class="try-editor document reload-page" href="doceditor.php?fileExt=docx" target="_blank">Create <br />Document</a></li>
                <li><a class="try-editor spreadsheet reload-page" href="doceditor.php?fileExt=xlsx" target="_blank">Create <br />Spreadsheet</a></li>
                <li><a class="try-editor presentation reload-page" href="doceditor.php?fileExt=pptx" target="_blank">Create <br />Presentation</a></li>
            </ul>
            <label class="create-sample">
                <input type="checkbox" id="createSample" class="checkbox" />Create a file filled with sample content
            </label>
            <br />
            <br />

            <div class="help-block">
                <span>Your documents</span>
                <br />
                <br />

                <div class="stored-list">
                    <div id="UserFiles">  
                        <table cellspacing="0" cellpadding="0" width="100%">
                            <thead>
                                <tr class="tableHeader">
                                    <td class="tableHeaderCell tableHeaderCellFileName">Filename</td>
                                    <td colspan="2" class="tableHeaderCell contentCells-shift">Editors</td>
                                    <td colspan="3" class="tableHeaderCell">Viewers</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $storedFiles = getStoredFiles();
                                foreach ($storedFiles as &$storeFile) 
                                {
                                    echo '<tr class="tableRow" title'.$storeFile->name.'>';
                                    echo ' <td class="contentCells">';
                                    echo '  <a class="stored-edit '.$storeFile->documentType.'" href="doceditor.php?fileID='.urlencode($storeFile->name).'" target="_blank">';
                                    echo '   <span title="'.$storeFile->name.'">'.$storeFile->name.'</span>';
                                    echo '  </a>';
                                    echo '  <a href="'.$storeFile->url.'">';
                                    echo '   <img class="icon-download" src="css/images/download-24.png" alt="download" /></a>';
                                    echo '  </a>';
                                    echo ' </td>';
                                    echo ' <td class="contentCells contentCells-icon">';
                                    echo '  <a href="doceditor.php?fileID='.urlencode($storeFile->name).'" target="_blank">';
                                    echo '   <img class="icon-download" src="css/images/desktop-24.png" alt="download" /></a>';
                                    echo '  </a>';
                                    echo ' </td>';
                                    echo ' <td class="contentCells contentCells-shift contentCells-icon">';
                                    echo '  <a href="doceditor.php?fileID='.urlencode($storeFile->name).'&type=mobile" target="_blank">';
                                    echo '   <img class="icon-download" src="css/images/mobile-24.png" alt="download" /></a>';
                                    echo '  </a>';
                                    echo ' </td>';
                                    echo ' <td class="contentCells contentCells-icon">';
                                    echo '  <a href="doceditor.php?fileID='.urlencode($storeFile->name).'&action=view" target="_blank">';
                                    echo '   <img class="icon-download" src="css/images/desktop-24.png" alt="download" /></a>';
                                    echo '  </a>';
                                    echo ' </td>';
                                    echo ' <td class="contentCells contentCells-icon">';
                                    echo '  <a href="doceditor.php?fileID='.urlencode($storeFile->name).'&action=view&type=mobile" target="_blank">';
                                    echo '   <img class="icon-download" src="css/images/mobile-24.png" alt="download" /></a>';
                                    echo '  </a>';
                                    echo ' </td>';
                                    echo ' <td class="contentCells contentCells-icon">';
                                    echo '  <a href="doceditor.php?fileID='.urlencode($storeFile->name).'&type=embedded" target="_blank">';
                                    echo '   <img class="icon-download" src="css/images/embeded-24.png" alt="download" /></a>';
                                    echo '  </a>';
                                    echo ' </td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <br />
            <br />
            <br />
            <div class="help-block">
                <span>Want to learn the magic?</span>
                <br />
                Explore ONLYOFFICE Integration Edition <a href="http://api.onlyoffice.com/editors/howitworks" target="_blank">API Documentation.</a>
            </div>
            <br />
            <br />
            <br />
            <div class="help-block">
                <span>Any questions?</span>
                <br />
                Please, <a href="mailto:sales@onlyoffice.com">submit your request here</a>.
            </div>
        </div>

        <div id="hint">
            <div class="corner"></div>
            If you check this option the file will be saved both in the original and converted into Office Open XML format for faster viewing and editing. In other case the document will be overwritten by its copy in Office Open XML format.
        </div>

        <div id="mainProgress">
            <div id="uploadSteps">
                <span id="step1" class="step">1. Loading the file</span>
                <span class="step-descr">The file loading process will take some time depending on the file size, presence or absence of additional elements in it (macros, etc.) and the connection speed.</span>
                <br />
                <span id="step2" class="step">2. File conversion</span>
                <span class="step-descr">The file is being converted into Office Open XML format for the document faster viewing and editing.</span>
                <br />
                <span id="step3" class="step">3. Loading editor scripts</span>
                <span class="step-descr">The scripts for the editor are loaded only once and are will be cached on your computer in future. It might take some time depending on the connection speed.</span>
                <input type="hidden" name="hiddenFileName" id="hiddenFileName" />
                <br />
                <br />
                <span class="progress-descr">Please note, that the speed of all operations greatly depends on the server and the client locations. In case they differ or are located in differernt countries/continents, there might be lack of speed and greater wait time. The best results are achieved when the server and client computers are located in one and the same place (city).</span>
                <br />
                <br />
                <div class="error-message">
                    <span></span>
                    <br />
                    Please select another file and try again. If you have questions please <a href="mailto:sales@onlyoffice.com">contact us.</a>
                </div>
            </div>
            <iframe id="embeddedView" src="" height="345px" width="600px" frameborder="0" scrolling="no" allowtransparency></iframe>
            <br />
            <div id="beginEmbedded" class="button disable">Embedded view</div>
            <div id="beginView" class="button disable">View</div>
            
            <?php if (($GLOBALS['MODE']) != "view") { ?>
            <div id="beginEdit" class="button disable">Edit</div>
            <?php } ?>
            <div id="cancelEdit" class="button gray">Cancel</div>
        </div>

        <span id="loadScripts" data-docs="<?php echo $GLOBALS['DOC_SERV_PRELOADER_URL'] ?>"></span>
        <footer>&copy; Ascensio Systems Inc <?php echo date("Y") ?>. All rights reserved.</footer>

    </form>
    </body>
</html>
