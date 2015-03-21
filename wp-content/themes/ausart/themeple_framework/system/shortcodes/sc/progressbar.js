scnShortcodeMeta={
	attributes:[
		{
			label:"Percentage",
			id:"percentage",
            help:"Use this if you dont want striped. Ignore success, warning, danger bars ",
			isRequired:true
		},
        
            {
		label:"Type",
		id:"type",
		help:"", 
		controlType:"select-control", 
		selectValues:['default','stacked']
   		 },
   		
              {
   		label:"Title",
   		id:"title",
   		help:"Tilte on progressbar"
   		},
              {
              label:"Description"
              id:"description",
              help:"Description on progressbar"
              } 
 
		],
		
		shortcode:"progressbar"
		
};