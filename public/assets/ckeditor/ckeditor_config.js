/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.uiColor = "#EE6E73";
    config.resize_enabled = true;
    config.toolbar = 'MyToolbar';
    config.docType = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">';
    config.entities = false;
    config.ignoreEmptyParagraph = true;
    config.ShowBorders = true;
    config.contentsCss = 'backend_style.css' ;
    config.stylesCombo_stylesSet = 'my_styles';
    config.enterMode = CKEDITOR.ENTER_BR;
    


    config.toolbar_MyToolbar =
    [
      ['Source','-'],
      ['Cut','Copy','Paste','PasteText','PasteFromWord','-','SpellChecker', 'Scayt'],
      ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],    
      '/',
      ['Styles','Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
      ['NumberedList','BulletedList'],
      ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
      ['Link','Unlink','Anchor'],
      ['Image','Table','HorizontalRule','SpecialChar'],
      ['Maximize', 'ShowBlocks']
  ];


CKEDITOR.addStylesSet( 'my_styles', 
[ 
 
    // Inline Styles 
    { name : 'text1', element : 'span', attributes : { 'class' : 'text1' } }, 
    { name : 'text2', element : 'span', attributes : { 'class' : 'text2' } }, 
    { name : 'text3', element : 'span', attributes : { 'class' : 'text3' } }, 
    { name : 'text4', element : 'span', attributes : { 'class' : 'text4' } }, 
    { name : 'text5', element : 'span', attributes : { 'class' : 'text5' } }, 
    { name : 'text6', element : 'span', attributes : { 'class' : 'text6' } }, 
    { name : 'text7', element : 'span', attributes : { 'class' : 'text7' } }, 
    { name : 'text8', element : 'span', attributes : { 'class' : 'text8' } },
    { name : 'text9', element : 'span', attributes : { 'class' : 'text9' } } 
]); 


};
