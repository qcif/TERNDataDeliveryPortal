   var licence_nc = false;
    var licence_sa = false;
    var licence_nd = false;
    var licence_copyright = false;

    
    function toggleND(value) {
        if (value === true) {
            licence_nd = false;
            licence_sa = false;
        } else if (value === 'true_sa') {
            licence_nd = false;
            licence_sa = true;
        } else {
            licence_nd = true;
            licence_sa = false;
        }
        prepareLicenceStatementAndIcon();
    }
    
    function toggleCopyright(value) {
        if (value === true) {
			$("#licence-cca").show();
            licence_copyright = true;
        } else {
			$("#licence-cca").hide();
            licence_copyright = false;
        }
    }
    
    function prepareLicenceStatementAndIcon() {
        var title = "This work";
        var creators = "";
        var attribution = "";
		var link_work = "";
        var tern_licence = "TERN Attribution";
        var statement = "";
        var icon_file = "/img/licence/BY";
        var link = "";
        var licence_link = "http://tern.org.au/datalicence/TERN-BY";
        
        if ($('#title').val() !== '') {
            title = $("#title").val();
        }
        /*
        if ($('#creators').val() !== '') {
            creators = "by " + $("#creators").val();
        }*/
        if ($('#attributionText').val() !== '') {
            attribution = "Please use the following attribution: " + $("#attributionText").val();
            
        }
		
		if ($('#link').val() !== '') {
            title = "<a target='_blank' href='" + $("#link").val() + "'>" + title + "</a>";
        }
        
        if (licence_nd) {
            tern_licence = tern_licence + "-No Derivatives";
            link = link + "-ND";
        }
        
        if (licence_sa) {
            tern_licence = tern_licence + "-Share Alike";
            link = link + "-SA";
        }
        
        licence_link = licence_link + link + "/1.0/";
        statement = title +  " is licensed under a <br/><a target='_blank' href='" + licence_link + "'>" + tern_licence + " licence</a>. " + attribution ;
        $("#licence-statement").html(statement);
        
        icon_file = icon_file + link + ".png";
        $("#licence-logo").attr("src",icon_file);
        $("#licence-logo-link").attr("href", licence_link);
		
		$("#licence-copy").val("<a href='" + licence_link + "'>"
			+ "<img height='60px' src='" + icon_file + "'/></a><br>" 
			+ statement);
    }
    
    function resetForm() {
        $('#licence-cca').hide();
        prepareLicenceStatementAndIcon();
    }
    
    $(document).ready(function(){        
		$("#attribution_button").click(function(){prepareLicenceStatementAndIcon()});
		$("#mods_true").click(function(){toggleND(true)});
		$("#mods_true_sa").click(function(){toggleND('true_sa')});
		$("#mods_false").click(function(){toggleND(false)});
		$("#copy_true").click(function(){toggleCopyright(true)});
		$("#copy_false").click(function(){toggleCopyright(false)});
		$("#copy_unsure").click(function(){toggleCopyright(false)});
                resetForm();
                
                $("#licensing-help-text").dialog({autoOpen:false, height: 300});
                $("#licensing-help").click(function(){
                    $("#licensing-help-text").dialog('open');
                    return false;
                });

	});