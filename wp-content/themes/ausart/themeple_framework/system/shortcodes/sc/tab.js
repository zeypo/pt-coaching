scnShortcodeMeta={

	attributes:[

		{

			label:"Tabs",

			id:"content",

			controlType:"tab-control"

		},

		

		{

		label:"Tab Positions",

		id:"position",

		help:"Position of the tabs", 

		controlType:"select-control", 

		selectValues:['top', 'left', 'right']

    },

		

		{

		label:"Fade Effect?",

		id:"fade",

		help:"", 

		controlType:"select-control", 

		selectValues:['yes', 'no']

    }

		],

		disablePreview:true,

		customMakeShortcode: function(b){

				

			var a=b.data;

			var tabTitles = new Array();

			

			if(!a)return"";

			

			var c=a.content;

			var pos= b.position;

			var fade= b.fade;

			var g = ''; // The shortcode.

			

			for ( var i = 0; i < a.numTabs; i++ ) {

			

				var currentField = 'tle_' + ( i + 1 );



				if ( b[currentField] == '' ) {

				

					tabTitles.push( 'Tab ' + ( i + 1 ) );

				

				} else {

				

					var currentTitle = b[currentField];

					

					currentTitle = currentTitle.replace( /"/gi, "'" );

					

					tabTitles.push( currentTitle );

				

				} // End IF Statement

			

			} // End FOR Loop

			

			g += '[tab_container position="'+pos+'"  fade="'+fade+'"]<br/><br/>';

			g += '[nav_tabs]<br/><br/>';

			i = 0;

            for ( var t in tabTitles ) {

                i++;

				g += '[tab id="'+i+'" title="' + tabTitles[t] + '"][/tab] <br/>';

			

			} // End FOR Loop

            g += '[/nav_tabs]<br/><br/>';

            g += '[tab_content_container]<br/><br/>';

            i = 0;

            for ( var t in tabTitles ) {

			    i++;

				g += '[tab_content id="'+i+'"]' + tabTitles[t] + ' content goes here.[/tab_content]<br/>';

			

			} // End FOR Loop

            g += '[/tab_content_container]<br/><br/>';

			g += '[/tab_container]';



			return g

		

		}

};