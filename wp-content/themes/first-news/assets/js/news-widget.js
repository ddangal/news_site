function News() { }

News.prototype.setCheckbox = function(widget) {
	var style = widget.find(jQuery('.news_style:checked')).val();
	var select = widget.find('.news_category');
	var tab = widget.find(jQuery('.category_tab')).parent()
	var bg_id = widget.find(jQuery('.background-img-id')).parent()
	var news_sidebar = widget.find(jQuery('.news_sidebar')).parent()
	var sidebar_postcount = widget.find(jQuery('.sidebar_postcount')).parent().parent()

 	if (style=="single"){
		select.removeAttr('multiple');
		tab.hide();
		sidebar_postcount.hide();
		news_sidebar.hide();
		bg_id.show();

	}else{
		select.attr("multiple","multiple");
		tab.show();
		bg_id.hide();
		this.setSidebar(widget);
	}
}
News.prototype.setSidebar = function(widget) {
	var ischecked= widget.find(jQuery('.news_sidebar')).is(':checked');
	var sidebar_postcount = widget.find(jQuery('.sidebar_postcount')).parent().parent();
    if(ischecked){
    	sidebar_postcount.show();
    }else{
    	sidebar_postcount.hide();
    }
}
News.prototype.resetForm = function() {
	var that = this;
	jQuery(".news_widget").each(function(){
		var widget = jQuery(this).closest('.widget');
		that.setCheckbox(widget);
		that.setSidebar(widget);
	})
}

jQuery(document).ready(function($){

	var n = new News(); 
	n.resetForm();

	$(document).on( 'click', '.news_style' ,function() {
		var widget= $(this).closest('.widget');
		n.setCheckbox(widget);
		});
	$(document).on( 'change', '.news_sidebar' ,function() {
		var widget= $(this).closest('.widget');
		n.setSidebar(widget);
		});
	$(document).ajaxStop(function() {
        n.resetForm();
    });
});