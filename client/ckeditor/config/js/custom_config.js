/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	
	config.defaultLanguage = 'nl';
	config.contentsLanguage = 'nl';
	config.contentsCss = 'CKeditor.php';
        
	config.filebrowserBrowseUrl = '../lcms2/app.php?mod=pagina&page=linkmenu&popup=true';
	config.filebrowserImageBrowseUrl = '../lcms2/app.php?mod=bestanden&popup=true&CKedit=true';
	config.filebrowserImageUploadUrl = '../lcms2/app.php?mod=bestanden&CKeditorUpload=true';
	config.filebrowserFlashBrowseUrl = '../lcms2/app.php?mod=bestanden&popup=true&CKedit=true';
	config.filebrowserFlashUploadUrl = '../lcms2/app.php?mod=bestanden&CKeditorUpload=true';

	config.enterMode = CKEDITOR.ENTER_BR;
	//config.enterMode = CKEDITOR.ENTER_P;
	config.autoParagraph = false;
	config.allowedContent = true;
	
	config.forcePasteAsPlainText = true;
	config.disableNativeSpellChecker = false;
	config.emailProtection = 'encode';
	config.toolbar = 'Custom';
	
	config.extraPlugins = 'youtube';
	config.youtube_related = false;
        

        //config.extraPlugins = 'iconfont';
	
	config.toolbarCanCollapse = true;
        
        config.startupOutlineBlocks = true;
	
	//The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbar_Custom =
	[
		['Source','-','NewPage','-','Templates'],
		['Cut','Copy','Paste','PasteText','PasteFromWord'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		['Link','Unlink','Anchor'],
		['Image','Flash','Youtube','Table','HorizontalRule','SpecialChar'],
		'/',
        ['Styles'],
		['Format','FontSize'],
		['TextColor','BGColor'],['ShowBlocks'],
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['IconFont']
	];
	config.toolbar_Basic =
	[
		['Source','-','Cut','Copy','Paste','PasteText','PasteFromWord'],
		['Link','Unlink','Anchor'],
		['Image','Table','HorizontalRule'],
		'/',
		['Format','FontSize'],
		['Bold','Italic','Underline','Strike'],
		['NumberedList','BulletedList','-','Outdent','Indent'],
        ['IconFont']
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	//config.removeButtons = 'Underline,Subscript,Superscript';
};

// load some extra plugins
// Enable local "iconfont" plugin from /plugins/iconfont/ folder.
//CKEDITOR.plugins.addExternal( 'iconfont', ckeditor_url_home+'ckeditor/plugins/iconfont/', 'plugin.js' );

CKEDITOR.stylesSet.add('default', [
        /* Block Styles */
        // These styles are already available in the "Format" combo ("format" plugin),
        // so they are not needed here by default. You may enable them to avoid
        // placing the "Format" combo in the toolbar, maintaining the same features.

        //{name: 'Kleuren kader', element: 'div', attributes: {'class': 'kader'}},
    ]
);

