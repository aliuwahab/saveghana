(function(){
/*********************/   
         tinymce.create('tinymce.plugins.toggle', {
      init: function(editor, url){
         editor.addButton('toggle', {
            title: 'Modify the text if you want to add more elements, past the sample text and then copy any number of times between markers [toggle][/toggle]',
            image: url+'/toggle.png',
            onclick: function(){
               editor.selection.setContent('&#91toggle&#93<h4>Move Cursor</h4><p>Content Here</p>&#91/toggle&#93');
            }
         });
      },
      createControl: function(n, cm){
         return null;
      },
   });
   tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);
/*********************/   
         tinymce.create('tinymce.plugins.columns_111', {
      init: function(editor, url){
         editor.addButton('columns_111', {
            title: 'Add the columns (1/3,1/3,1/3)',
            image: url+'/columns111.png',
            onclick: function(){
               editor.selection.setContent('&#91columns_111&#93 &#91col_1&#93Content here &#91/col_1&#93 &#91col_1&#93Content here &#91/col_1&#93 &#91col_1&#93Content here &#91/col_1&#93 <br />&#91/columns_111&#93<br />');
            }
         });
      },
      createControl: function(n, cm){
         return null;
      },
   });
   tinymce.PluginManager.add('columns_111', tinymce.plugins.columns_111);
/*********************/   
         tinymce.create('tinymce.plugins.columns_12', {
      init: function(editor, url){
         editor.addButton('columns_12', {
            title: 'Add the columns (1/3,2/3)',
            image: url+'/columns12.png',
            onclick: function(){
               editor.selection.setContent('&#91columns_12&#93 &#91col_1&#93Content here &#91/col_1&#93 &#91col_2&#93Content here &#91/col_2&#93&#91/columns_12&#93<br />');
            }
         });
      },
      createControl: function(n, cm){
         return null;
      },
   });
   tinymce.PluginManager.add('columns_12', tinymce.plugins.columns_12);
/*********************/   
         tinymce.create('tinymce.plugins.columns_21', {
      init: function(editor, url){
         editor.addButton('columns_21', {
            title: 'Add the columns (2/3,1/3)',
            image: url+'/columns21.png',
            onclick: function(){
               editor.selection.setContent('&#91columns_21&#93 &#91col_2&#93Content here &#91/col_2&#93 &#91col_1&#93Content here &#91/col_1&#93 &#91/columns_21&#93<br />');
            }
         });
      },
      createControl: function(n, cm){
         return null;
      },
   });
   tinymce.PluginManager.add('columns_21', tinymce.plugins.columns_21);
/*********************/  
         tinymce.create('tinymce.plugins.columns_11', {
      init: function(editor, url){
         editor.addButton('columns_11', {
            title: 'Add the columns (1/2,1/2)',
            image: url+'/columns11.png',
            onclick: function(){
               editor.selection.setContent('&#91columns_11&#93 &#91col_1_1&#93Content here &#91/col_1_1&#93 &#91col_1_1&#93Content here &#91/col_1_1&#93&#91/columns_11&#93<br />');
            }
         });
      },
      createControl: function(n, cm){
         return null;
      },
   });
   tinymce.PluginManager.add('columns_11', tinymce.plugins.columns_11);
/*********************/   
   
})();