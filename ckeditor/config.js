/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.filebrowserBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=flash';


	/// / Define changes to default configuration here. For example:
	 config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.toolbar = [
        { name : 'basicstyles' , items : ['Bold','Italic','Strike','-','RemoveFormat']},
        { name : 'clipboard' , items : ['Cut','Copy','Paste','-','Undo','Redo']},
        { name : 'paragraph' , items : ['BulletedList','Outdent','Indent','-','Blockquote','Justifyleft','Justifycenter','Justifyright']},
        { name : 'styles' , items : ['Styles','Format','FontSize','TextColor']},
        { name : 'tools' , items : ['Maximize']},
        '/',
        { name : 'links' , items : ['Link','Unlink','Anchor']},
        { name : 'insert' , items : ['Image','Iframe','-','Table','Accordionlist','Smiley']},
        { name : 'editing' , items : ['Scayt','Autocorrect','SelectAll','Find','Replace']},

    ]
};































