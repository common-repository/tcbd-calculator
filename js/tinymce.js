(function() {
	tinymce.PluginManager.add('tcbd_calculator_mce_button', function( editor, url ) {
		editor.addButton('tcbd_calculator_mce_button', {
			icon: false,
			type: 'button',
			title: 'TCBD Calculator',
			image : url + '/icon.png',
			onclick: function() {
				editor.insertContent('[tcbd-calculator]');
			}
		});
	});
})();