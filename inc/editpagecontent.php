<?php

$pname = $_SESSION['CurrentProductName'];
$pid = $_SESSION['CurrentProductID'];
 
$footer = '<div class="form-horizontal form-row-seperated">
            <div class="modal fade" id="myModal" data-backdrop="static" aria-hidden="true" data-width="1250">
    <br>
    <!-- header -->
    <header class="navbar navbar-static-top bg-green-meadow" id="top">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand ex-large-font">This is how your picture will look on SweetReferrals site</span>
            </div>
        </div>
    </header>

    <div class="container" style="margin-left: 35px">
        <div class="row">
            <div class="col-md-7">
                <div class="img-container">
                    <img id="prod-img" src="" alt="Picture">
                </div>
            </div>
            <div class="col-md-4">
                <div></div>
                <div class="overlayImageBackGround docs-preview clearfix" >
                    <div class="img-preview preview-lg"></div>
                </div>
                <button type="button" class="btn green-jungle rounded-4" data-method="getCroppedCanvas">
                   <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Get cropped canvas">
                      Crop
                   </span>
                </button>
                <button class="btn btn-default yellow rounded-4" id="no-crop">Don\'t Crop</button>
                <button class="btn btn-default rounded-4" id="close">Cancel</button>
                <button class="hide" data-dismiss="modal" id="close1"></button>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 docs-buttons">
                <div class="btn-group">
                    <button type="button" class="btn btn-default rounded-4" data-method="setDragMode" data-option="move" title="Move">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Set drag mode">
                            <span class="fa fa-arrows"></span>
                        </span>
                    </button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default rounded-4" data-method="zoom" data-option="0.1" title="Zoom In">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Zoom 0.1">
                            <span class="fa fa-search-plus"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-default rounded-4" data-method="zoom" data-option="-0.1" title="Zoom Out">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Zoom -0.1">
                            <span class="fa fa-search-minus"></span>
                        </span>
                    </button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default rounded-4" data-method="rotate" data-option="-45" title="Rotate Left">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Rotate -45">
                            <span class="fa fa-rotate-left"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-default rounded-4" data-method="rotate" data-option="45" title="Rotate Right">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Rotate +45">
                            <span class="fa fa-rotate-right"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="col-md-5 docs-toggles" style="margin-left: -67px;">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-default active" data-method="setAspectRatio" data-option="1.7777777777777777" title="Set Aspect Ratio">
                            <div class="radio" id="uniform-aspestRatio1" style="display: none;"><span><input type="radio" class="sr-only hide" id="aspestRatio1" name="aspestRatio" value="1.7777777777777777" style="display: inline-block;"></span></div>
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Set aspect ratio 16 / 9)">
                                16:9
                            </span>
                    </label>
                    <label class="btn btn-default rounded-4" data-method="setAspectRatio" data-option="1.3333333333333333" title="Set Aspect Ratio">
                        <div class="radio" id="uniform-aspestRatio2" style="display: none;"><span><input type="radio" class="sr-only  hide" id="aspestRatio2" name="aspestRatio" value="1.3333333333333333" style="display: inline-block;"></span></div>
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Set aspect ratio 4 / 3">
                            4:3
                        </span>
                    </label>
                    <label class="btn btn-default rounded-4" data-method="setAspectRatio" data-option="1" title="Set Aspect Ratio">
                        <div class="radio" id="uniform-aspestRatio3" style="display: none;"><span><input type="radio" class="sr-only hide" id="aspestRatio3" name="aspestRatio" value="1" style="display: inline-block;"></span></div>
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Set aspect ratio 1 / 1">
                            1:1
                        </span>
                    </label>
                    <label class="btn btn-default rounded-4" data-method="setAspectRatio" data-option="0.6666666666666666" title="Set Aspect Ratio">
                        <div class="radio" id="uniform-aspestRatio4" style="display: none;"><span><input type="radio" class="sr-only hide" id="aspestRatio4" name="aspestRatio" value="0.6666666666666666" style="display: inline-block;"></span></div>
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Set aspect ratio 2 / 3">
                            2:3
                        </span>
                    </label>
                    <label class="btn btn-default rounded-4" data-method="setAspectRatio" data-option="NaN" title="Set Aspect Ratio">
                        <div class="radio" id="uniform-aspestRatio5" style="display: none;"><span><input type="radio" class="sr-only hide" id="aspestRatio5" name="aspestRatio" value="NaN" style="display: inline-block;"></span></div>
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Set aspect ratio NaN">
                            Free
                        </span>
                    </label>
                </div>
            </div><!-- /.docs-toggles -->

                <!-- Show the cropped image in modal -->
                <div class="modal fade docs-cropped background-transparent" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content croppedImageModal">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="getCroppedCanvasTitle">Ready to crop?</h4>
                            </div>
                            <p class="margin-10">You can only crop your image once, so please make sure it\'s good to go. But if you do have any issues, you can always re-upload your picture and re-submit.</p>
                            <div class="modal-body" id="croppedImage">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default rounded-4" id="cancel" data-dismiss="modal">Close</button>
                                <button type="button" class="btn green-jungle rounded-4" id="ok" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
            </div><!-- /.docs-buttons -->

        </div>
    </div>

            <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" data-width="500">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Ready to submit?</h4>
        </div>

        <div class="modal-body">
        Great, now let\'s get to the fun stuff! The next step is to add Personas for your product, so we can recommend it to the right consumers.
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default rounded-4" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn green-jungle rounded-4" id="saveAndSubmit" data-dismiss="modal">Lets Go!</button>
        </div>

    </div>
</div>

            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
    				    <span class="caption-subject font-green-haze bold uppercase">Edit Product </span>
                        <span class="caption-helper">aloo</span> &nbsp;
                        <span id="progressText" class="caption-subject font-green-haze bold">Your profile is 10% complete.</span>
                    </div>

                    <div class="actions btn-set">
                        <span id="timer"></span>
                        <a hidden="hidden"  data-toggle="modal" id="submit"></a>
                        <button class="btn btn-default rounded-4 save" id="save">Save and Next Step</button>
                        <button class="btn green-jungle rounded-4 submit1" id="submit1"><i class="fa fa-check"></i> Submit Profile</button>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="tabbable tabbable-custom nav-justified" id="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li id="tab1" class="active">
                                <a  data-toggle="tab" aria-expanded="true">
                                    <span class="tab-heading">1. Product Essentials </span>
                                </a>
                            </li>

                            <li id="tab2" class="">
                                <a  data-toggle="tab" aria-expanded="false">
                                    <span class="tab-heading">2. Product Images </span>
                                </a>
                            </li>
                            
                        </ul>

                                                    <a class="hidden" data-toggle="modal" data-backdrop="static" id="category_button" ></a>

                                <div id="add_category" class="modal fade" tabindex="-1" data-width="500">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Select your product category</h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="javascript:;" class="alert alert-success alert-borderless">
                                                    <input type="text" class="form-control input-lg clearable" id="categorySearch" placeholder="Type here to search for category..." value="">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                            <div class="categoryTreeHeight box jstree jstree-1 jstree-default jstree-default-responsive" id="productCategory" role="tree"><ul class="jstree-container-ul jstree-children jstree-wholerow-ul jstree-no-dots"><li role="treeitem" aria-expanded="false" id="3" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Beverages</a></li><li role="treeitem" aria-expanded="false" id="38" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Food</a></li><li role="treeitem" aria-expanded="false" id="247" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Household Supplies</a></li><li role="treeitem" aria-expanded="false" id="285" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Health &amp; Beauty</a></li><li role="treeitem" aria-expanded="false" id="513" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Family</a></li><li role="treeitem" aria-expanded="false" id="532" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Animals &amp; Pet Supplies</a></li><li role="treeitem" aria-expanded="false" id="640" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Apparel &amp; Accessories</a></li><li role="treeitem" aria-expanded="false" id="648" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Arts &amp; Entertainment</a></li><li role="treeitem" aria-expanded="false" id="675" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Cameras &amp; Optics</a></li><li role="treeitem" aria-expanded="false" id="729" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Hardware</a></li><li role="treeitem" aria-expanded="false" id="750" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Home &amp; Garden</a></li><li role="treeitem" aria-expanded="false" id="772" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Luggage &amp; Bags</a></li><li role="treeitem" aria-expanded="false" id="811" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Software</a></li><li role="treeitem" aria-expanded="false" id="815" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Sporting Goods</a></li><li role="treeitem" aria-expanded="false" id="828" class="jstree-node  jstree-closed"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Toys &amp; Games</a></li><li role="treeitem" id="834" class="jstree-node  jstree-leaf jstree-last"><div unselectable="on" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl"></i><a class="jstree-anchor" ><i class="jstree-icon jstree-themeicon fa fa-circle-o jstree-themeicon-custom"></i>Automotive</a></li></ul></div>
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn green-haze rounded-4" data-dismiss="modal" id="categoryOk" hidden=""><i class="fa fa-check"></i> Select
                                        </button>
                                        <button type="button" class="btn grey rounded-4" data-dismiss="modal" id="categoryCancel"> Cancel
                                        </button>
                                    </div>
                                </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                <br>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name: <span class="required">* </span></label>
                                    <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="name" class="form-control input-lg" name="product[name]" value="aloo" placeholder="Name of Product">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category : <span class="required">* </span></label>
                                    <div class="col-md-9" id="cate" data-original-title="" title="">
                                                                                                                <input type="text" id="categories" class="form-control input-lg cursorCategory" name="category" value="" placeholder="Category of Product">
                                        <input class="hidden" id="categoriesId" type="text" value="">
                                                                        </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description: <span class="required">* </span></label>
                                    <div class="col-md-9" id="desc" data-original-title="" title="">
                                        <div id="descDiv">
                                            <div id="description" class="form-control input-lg" style="display: none;">
                                                <ul></ul>
                                            </div><div class="note-editor"><div class="note-dropzone"><div class="note-dropzone-message"></div></div><div class="note-dialog"><div class="note-image-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">×</button><h4 class="modal-title">Insert Image</h4></div><form class="note-modal-form"><div class="modal-body"><div class="row-fluid"><div class="note-group-select-from-files"><h5>Select from files</h5><input class="note-image-input" type="file" name="files" accept="image/*"></div><h5>Image URL</h5><input class="note-image-url form-control span12" type="text"></div></div><div class="modal-footer"><button href="#" class="btn btn-primary note-image-btn disabled" disabled="">Insert Image</button></div></form></div></div></div><div class="note-link-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">×</button><h4 class="modal-title">Insert Link</h4></div><form class="note-modal-form"><div class="modal-body"><div class="row-fluid"><div class="form-group"><label>Text to display</label><input class="note-link-text form-control span12" type="text"></div><div class="form-group"><label>To what URL should this link go?</label><input class="note-link-url form-control span12" type="text"></div><div class="checkbox"><label><input type="checkbox" checked=""> Open in new window</label></div></div></div><div class="modal-footer"><button href="#" class="btn btn-primary note-link-btn disabled" disabled="">Insert Link</button></div></form></div></div></div><div class="note-video-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">×</button><h4 class="modal-title">Insert Video</h4></div><form class="note-modal-form"><div class="modal-body"><div class="row-fluid"><div class="form-group"><label>Video URL?</label>&nbsp;<small class="text-muted">(YouTube, Vimeo, Vine, Instagram, DailyMotion or Youku)</small><input class="note-video-url form-control span12" type="text"></div></div></div><div class="modal-footer"><button href="#" class="btn btn-primary note-video-btn disabled" disabled="">Insert Video</button></div></form></div></div></div><div class="note-help-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><form class="note-modal-form"><div class="modal-body"><div class="row-fluid"><a class="modal-close pull-right" aria-hidden="true" tabindex="-1">Close</a><div class="title">Keyboard shortcuts</div><table class="note-shortcut-layout"><tbody><tr><td><table class="note-shortcut"><thead><tr><th></th><th>Action</th></tr></thead><tbody><tr><td>Ctrl + Z</td><td>Undo</td></tr><tr><td>Ctrl + Shift + Z</td><td>Redo</td></tr><tr><td>Ctrl + ]</td><td>Indent</td></tr><tr><td>Ctrl + [</td><td>Outdent</td></tr><tr><td>Ctrl + ENTER</td><td>Insert Horizontal Rule</td></tr></tbody></table></td><td><table class="note-shortcut"><thead><tr><th></th><th>Text formatting</th></tr></thead><tbody><tr><td>Ctrl + B</td><td>Bold</td></tr><tr><td>Ctrl + I</td><td>Italic</td></tr><tr><td>Ctrl + U</td><td>Underline</td></tr><tr><td>Ctrl + Shift + S</td><td>Strikethrough</td></tr><tr><td>Ctrl + \</td><td>Remove Font Style</td></tr></tbody></table></td></tr><tr><td><table class="note-shortcut"><thead><tr><th></th><th>Document Style</th></tr></thead><tbody><tr><td>Ctrl + NUM0</td><td>Normal</td></tr><tr><td>Ctrl + NUM1</td><td>Header 1</td></tr><tr><td>Ctrl + NUM2</td><td>Header 2</td></tr><tr><td>Ctrl + NUM3</td><td>Header 3</td></tr><tr><td>Ctrl + NUM4</td><td>Header 4</td></tr><tr><td>Ctrl + NUM5</td><td>Header 5</td></tr><tr><td>Ctrl + NUM6</td><td>Header 6</td></tr></tbody></table></td><td><table class="note-shortcut"><thead><tr><th></th><th>Paragraph formatting</th></tr></thead><tbody><tr><td>Ctrl + Shift + L</td><td>Align left</td></tr><tr><td>Ctrl + Shift + E</td><td>Align center</td></tr><tr><td>Ctrl + Shift + R</td><td>Align right</td></tr><tr><td>Ctrl + Shift + J</td><td>Justify full</td></tr><tr><td>Ctrl + Shift + NUM7</td><td>Ordered list</td></tr><tr><td>Ctrl + Shift + NUM8</td><td>Unordered list</td></tr></tbody></table></td></tr></tbody></table><p class="text-center"><a href="https://hackerwins.github.io/summernote/" target="_blank">Summernote 0.5.10</a> · <a href="https://github.com/HackerWins/summernote" target="_blank">Project</a> · <a href="https://github.com/HackerWins/summernote/issues" target="_blank">Issues</a></p></div></div></form></div></div></div></div><div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div><div class="note-popover"><div class="note-link-popover popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content"><a href="http://www.google.com/" target="_blank">www.google.com</a>&nbsp;&nbsp;<div class="note-insert btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="showLinkDialog" data-hide="true" tabindex="-1" data-original-title="Edit (CTRL+K)"><i class="fa fa-edit icon-edit"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="unlink" tabindex="-1" data-original-title="Unlink"><i class="fa fa-unlink icon-unlink"></i></button></div></div></div><div class="note-image-popover popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content"><div class="btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="resize" data-value="1" tabindex="-1" data-original-title="Resize Full"><span class="note-fontsize-10">100%</span></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="resize" data-value="0.5" tabindex="-1" data-original-title="Resize Half"><span class="note-fontsize-10">50%</span></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="resize" data-value="0.25" tabindex="-1" data-original-title="Resize Quarter"><span class="note-fontsize-10">25%</span></button></div><div class="btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="floatMe" data-value="left" tabindex="-1" data-original-title="Float Left"><i class="fa fa-align-left icon-align-left"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="floatMe" data-value="right" tabindex="-1" data-original-title="Float Right"><i class="fa fa-align-right icon-align-right"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="floatMe" data-value="none" tabindex="-1" data-original-title="Float None"><i class="fa fa-align-justify icon-align-justify"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="imageShape" data-value="img-rounded" tabindex="-1" data-original-title="Shape: Rounded"><i class="fa fa-square icon-unchecked"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="imageShape" data-value="img-circle" tabindex="-1" data-original-title="Shape: Circle"><i class="fa fa-circle-o icon-circle-blank"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="imageShape" data-value="img-thumbnail" tabindex="-1" data-original-title="Shape: Thumbnail"><i class="fa fa-picture-o icon-picture"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="imageShape" tabindex="-1" data-original-title="Shape: None"><i class="fa fa-times icon-times"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="removeMedia" data-value="none" tabindex="-1" data-original-title="Remove Image"><i class="fa fa-trash-o icon-trash"></i></button></div></div></div></div><div class="note-toolbar btn-toolbar"><div class="note-style btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="bold" tabindex="-1" data-original-title="Bold (CTRL+B)"><i class="fa fa-bold icon-bold"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="italic" tabindex="-1" data-original-title="Italic (CTRL+I)"><i class="fa fa-italic icon-italic"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="underline" tabindex="-1" data-original-title="Underline (CTRL+U)"><i class="fa fa-underline icon-underline"></i></button></div><div class="note-para btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="insertUnorderedList" tabindex="-1" data-original-title="Unordered list (CTRL+SHIFT+NUM7)"><i class="fa fa-list-ul icon-list-ul"></i></button><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="insertOrderedList" tabindex="-1" data-original-title="Ordered list (CTRL+SHIFT+NUM8)"><i class="fa fa-list-ol icon-list-ol"></i></button></div></div><textarea class="note-codable"></textarea><div class="note-editable" contenteditable="true" style="height: 100px;"></div><div class="note-statusbar"><div class="note-resizebar"><div class="note-icon-bar"></div><div class="note-icon-bar"></div><div class="note-icon-bar"></div></div></div></div>
                                        </div>
                                        <p class="help-block custom-font">&nbsp;Don\'t add hyperlinks and coupon codes.</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Certifications :</label>
                                    <div class="col-md-9">
                                        <div class="select2-container select2-container-multi form-control select2me input-lg" id="s2id_certifications"><ul class="select2-choices">  <li class="select2-search-field">    <label for="s2id_autogen2" class="select2-offscreen"></label>    <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input select2-default" id="s2id_autogen2" style="width: 413px;" placeholder="">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   <li class="select2-no-results">No matches found</li></ul></div></div><select class="form-control select2me input-lg select2-offscreen" id="certifications" multiple="multiple" tabindex="-1">
                                            0
                                                                                            0
                                                                                                    <option value="1">Vegan</option>
                                                                                                                                            0
                                                                                                    <option value="2">Glutenfree</option>
                                                                                                                                            0
                                                                                                    <option value="3">Organic</option>
                                                                                                                                            0
                                                                                                    <option value="4">Kosher</option>
                                                                                                                                            0
                                                                                                    <option value="5">Fairtrade</option>
                                                                                                                                            0
                                                                                                    <option value="6">Non-GMO</option>
                                                                                                                                            0
                                                                                                    <option value="7">Cruelty-Free</option>
                                                                                                                                            0
                                                                                                    <option value="8">BPA-Free</option>
                                                                                                                                    </select>
                                        <p class="help-block custom-font">&nbsp;Please only choose options have already been certified for.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Features :</label>
                                    <div class="col-md-9" id="feat" data-original-title="" title=""><div data-reactid=".0"><div class="row" data-reactid=".0.0"><div class="col-md-10" data-reactid=".0.0.0"><label class="sr-only" for="todoInput" data-reactid=".0.0.0.0"></label><input type="text" class="form-control input-lg keypress" placeholder="Add features you want to highlight about your product..." data-reactid=".0.0.0.1"></div><div class="col-md-2 button-margin" data-reactid=".0.0.1"><a id="addFeatures" class="input-group-btn btn btn-icon-only purple-color button-height" data-reactid=".0.0.1.0"><i class="fa fa-plus iconClass addList" data-reactid=".0.0.1.0.0"></i></a></div><div class="ulPadding col-md-12" data-reactid=".0.0.2"></div></div></div></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Keywords :</label>
                                    <div class="col-md-9" id="keyw" data-original-title="" title="">
                                      <input id="keywords" type="text" class="tags form-control input-lg " value="" style="display: none;"><div id="keywords_tagsinput" class="tagsinput form-control input-lg" style="width: 100%; height: 100px;"><div id="keywords_addTag"><input id="keywords_tag" value="" data-default="" style="color: rgb(102, 102, 102); width: 138px;"></div><div class="tags_clear"></div></div>
                                      <p class="help-block custom-font">&nbsp;Add some keywords to help your product page\'s SEO. We suggest 7-10 keywords that describe your product\'s category or benefits.</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Awards :</label>
                                    <div class="col-md-9" id="awards" data-original-title="" title=""><div data-reactid=".1"><div class="row" data-reactid=".1.0"><div class="col-md-10" data-reactid=".1.0.0"><label class="sr-only" for="todoInput" data-reactid=".1.0.0.0"></label><input type="text" class="form-control input-lg" placeholder="Add awards..." data-reactid=".1.0.0.1"></div><div class="col-md-2 button-margin" data-reactid=".1.0.1"><a id="addAwards" class="input-group-btn btn btn-icon-only purple-color button-height" data-reactid=".1.0.1.0"><i class="fa fa-plus iconClass addList" data-reactid=".1.0.1.0.0"></i></a></div><div class="ulPadding col-md-12" data-reactid=".1.0.2"></div></div></div></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product\'s Website :</label>
                                    <div class="col-md-9" id="link">
                                        <div id="websiteDiv">
                                             <input id="website" type="url" class="tags form-control input-lg " value="" placeholder="http://yourcompany.com/yourproduct">
                                       </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                                <input id="reactFeatures" type="hidden" value="">
                                <input id="reactAwards" type="hidden" value="">
                           </div>
                        </div>

                                                <div class="tab-pane" id="tab_images">
                            <br>
                            <br>
                            <div class="row fileupload-buttonbar">

                                <div class="col-md-3" id="addPictureLabel" data-trigger="click" data-placement="top" data-toggle="popover" data-content="Please wait, your picture is being uploaded." data-original-title="" title="">
                                    <label class="font-blue-dark fileinput-button uploadButton" for="inputImage" id="pictureButtonSpan" title="Upload image file">
                                        <a class="js-choose-computer btn green-haze">
                                            <i class="fa fa-plus" for="inputImage"></i>
                                            <span for="inputImage">Add Product Pictures...</span>
                                        </a>
                                        <input type="file" multiple="" class="sr-only hide" id="inputImage" name="file" accept="image/*">
                                    </label>
                                    </div>

                                <div class="col-md-9 upload-tip">
                                    <p class="help-block">Tip : Picture should be .jpg or .png and recommended dimensions are more then 700 X 350. Each picture can be up to 5MB.</p>
                                </div>

                                <br><br><br>

                                <div id="imageDiv">
                                                                        </div>
                            </div>
                        </div>

                                                        <div class="tab-pane" id="tab_preview">
                                <div class="center">
                                    <br>
                                    <i id="loader1" class="fa fa-spinner fa-spin fa-3x"></i>
                                    <div id="IframeWrapper" style="position: relative;">
                                        <div id="iframeBlocker" style="position: absolute; top: 0; left: 0; width: 1050px; height: 1000px"></div>
                                        <iframe height="1000px" width="100%" id="preview"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                                                <div class="pull-right">
                            <div class="actions btn-set">
                                <span id="timer"></span>
                                <button type="button" class="btn btn-default btn-lg rounded-4 save" id="save1">Save and Next Step</button>
                                <button class="btn btn-lg green-jungle rounded-4 submit1" id="submit1"><i class="fa fa-check"></i> Submit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

echo $footer;