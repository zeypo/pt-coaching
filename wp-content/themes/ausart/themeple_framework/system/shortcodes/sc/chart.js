scnShortcodeMeta={
	attributes:[
		{
			label:"Data",
			id:"data",
			isRequired:true
		},
		{
			label:"Colors",
			id:"colors",
			help:"Add colors separated with commas?"
            
        },
        {
			label:"Size",
			id:"size",
			help:"Enter the size with this format ex 400X600",
            
        },
        {
			label:"Background",
			id:"bg",
			help:"Set the background color you want",
            
        },
        {
			label:"Title",
			id:"title",
			help:"Type the title for the chart"
			
        },
        {
			label:"Labels",
			id:"labels",
			help:"Type the labels separated wtih commas"
            
        },
        {
			label:"Advanced",
			id:"advanced",
           
        },
        {
			label:"Type",
			id:"type",
			help:"Select the type of the chart you want to show",
            controlType:"select-control", 
			selectValues:['line', 'xyline', 'sparkline', 'meter', 'scatter', 'venn', 'pie', 'pie2d']
        },
        
		],
		
		shortcode:"chart"
};