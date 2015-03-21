scnShortcodeMeta={
	attributes:[
		
		{
			label:"Type",
			id:"type",
			help:"Select the type of the column",
            controlType:"select-control", 
			selectValues:['level-one', 'level-max']
        },

        {
			label:"Do you want header",
			id:"header_bool",
			help:"",
            controlType:"select-control", 
			selectValues:['yes', 'no']
        },
        {
            label:"Header Title background color",
			id:"title_bg",
			help:"Set the title background color",
            defaultValue: '#2c2c2c', 
		    defaultText: '#2c2c2c'
        },
        {
            label:"Price Background Color",
			id:"price_bg",
			help:"Set the price background color",
            defaultValue: '#3a3a3a', 
		    defaultText: '#3a3a3a' 
        },

        {
			label:"Header Title",
			id:"header_title",
			help:"The title to be used for the column"
            
        },
        {
			label:"Header Money",
			id:"header_money",
			help:"Type the price"
            
        },
          
         {
			label:"Period",
			id:"period",
			help:"Set the period of time (per month)"
            
        },

        {
			label:"Do you want Footer",
			id:"footer_bool",
			help:"",
            controlType:"select-control", 
			selectValues:['yes', 'no']
        },
        {
			label:"Button Text",
			id:"footer_button_text",
			help:""
            
        },
        {
			label:"Button Link",
			id:"footer_link",
			help:""
            
        }
		],
		 defaultContent:"Add price table rows",
		shortcode:"price_table_1"
};