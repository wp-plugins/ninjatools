function NINJATOOLS(){
    var $ = jQuery;
    var d = document;

    this.options = null;
    this.dragging_obj = null;
    this.setDraggingObj = function(obj){
        this.dragging_obj = obj;
    };
    this.getDraggingObj = function(){
        return this.dragging_obj;
    };
    this.showLogin = function() {
        $(".ninjatools_admin .login").fadeIn();
    };
    this.delTool = function(service) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            cache: false,
            async: false,
            data: {
                "action": NINJATOOLS_ADMIN.action,
                "query": {
                    action: "delTool",
                    deactivate: true,
                    service: service
                }
            },
            url: NINJATOOLS_ADMIN.endpoint,
            context: this,
            success: function (data) {
                if (data.result == true) {
                    ninjatools.options = data.options ;
                }
            }
        });
    };
    this.setTool = function(service, toolid, toolname, place) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            cache: false,
            async: false,
            data: {
                "action": NINJATOOLS_ADMIN.action,
                "query": {
                    action: "setTool",
                    public_key: this.options.public_key,
                    service: service,
                    toolid: toolid,
                    toolname: toolname,
                    place: place
                }
            },
            url: NINJATOOLS_ADMIN.endpoint,
            context: this,
            success: function (data) {
                if (data.result == true) {
                    ninjatools.options = data.options;  
                }
            }
        });
    };

    this.getOption = function() {
        $.ajax({
            type: 'POST',
            dataType: "json",
            cache: false,
            async: false,
            data: {
                "action": NINJATOOLS_ADMIN.action,
                "query": { action: "getOption"}
            },
            url: NINJATOOLS_ADMIN.endpoint,
            context: this,
            success: function (data) {
                //console.log(data);
                this.options = data;
            }
        });
        return this.options;
    };

    this.getTools = function() {
        $.ajax({
            type: 'POST',
            dataType: "json",
            cache: false,
            async: false,
            data: {
                "action": NINJATOOLS_ADMIN.action,
                "query": {
                    action: "getTools"
                }
            },
            url: NINJATOOLS_ADMIN.endpoint,
            context: this,
            success: function (data) {
                if (data.result === true) {
                    ninjatools.options = data.options;

                    $("#tools").html("");
                    if (data.tool_list == false) {
                        $("#tools").text("<?php _e("No available tools. Please create tool after sign in Ninja Tools, or use another Ninja Tools account.", NINJATOOLS_DOMAIN);?>");
                    }else{
                        $(".ninjatools_admin .ntwpp_memo").show();
                        var div_group_analyze = $(d.createElement("div")).addClass("group");
                        var span_analyze = $(d.createElement("span")).text('<?php _e("Ninja Analyze", NINJATOOLS_DOMAIN);?>');
                        var span_toollist = $(d.createElement("span")).text('<?php _e("Tool List", NINJATOOLS_DOMAIN);?>').addClass("nomal");
                        var h3_analyze = $(d.createElement('h3')).addClass("subti_na_ana").append(span_analyze).append(span_toollist);
                        var div_analyze = $(d.createElement("div")).addClass("analyze");
                        div_group_analyze.append(h3_analyze).append(div_analyze);

                        var div_lastline = $(d.createElement("div")).addClass("last_line");

                        var div_group_omatome = $(d.createElement("div")).addClass("group");
                        var span_omatome = $(d.createElement("span")).text('<?php _e("Ninja Omatome", NINJATOOLS_DOMAIN);?>');
                        var span_toollist = $(d.createElement("span")).text('<?php _e("Tool List", NINJATOOLS_DOMAIN);?>').addClass("nomal");
                        var h3_omatome = $(d.createElement('h3')).addClass("subti_na_oma").append(span_omatome).append(span_toollist);
                        var div_omatome = $(d.createElement("div")).addClass("omatome");
                        div_group_omatome.append(h3_omatome).append(div_omatome);

                        var div_lastline1 = $(d.createElement("div")).addClass("last_line");
                        var div_lastline2 = $(d.createElement("div")).addClass("last_line");
                        $("#tools").append(div_group_analyze).append(div_lastline1).append(div_group_omatome).append(div_lastline2);
                        $("#tools").append(div_group_omatome).append(div_lastline1).append(div_group_analyze).append(div_lastline2);


                    }
                    for (service in data.tool_list) {
                        for (tool in data.tool_list[service]) {
                            var title_div = $(d.createElement('div')).addClass("title_div").addClass(service).text(data.tool_list[service][tool]);
                            var handle_div = $(d.createElement('div')).addClass("handle_div").addClass(service);
                            var clear_div = $(d.createElement('div')).addClass("clear");

                            var item_div = $(d.createElement('div')).attr("data-service", service).attr("data-toolid", tool).attr("data-toolname", data.tool_list[service][tool]).addClass("item").addClass(service).append(title_div).append(handle_div).append(clear_div).draggable({
                                handle: ".handle_div",
                                start: function(e, ui){
                                    ninjatools.setDraggingObj(this);
                                    var service = $(this).attr("data-service");
                                    if (service == "analyze") {
                                        $(".sidebar,.footer").addClass("dragging").addClass(service);
                                    }else{
                                        $(".sidebar,.article").addClass("dragging").addClass(service);
                                    }

                                },

                                stop: function(){
                                    ninjatools.setDraggingObj(null);
                                    var service = $(this).attr("data-service");
                                    if (service == "analyze") {
                                        $(".sidebar,.footer").removeClass("dragging").removeClass(service);
                                    }else{
                                        $(".sidebar,.article").removeClass("dragging").removeClass(service);
                                    }
                                    if ($(this).attr("data-dropped_area") != "1") {
                                        $(this).css("left", "0").css("top", "0");
                                    }
                                }
                            });
                            $("#tools>div.group>div." + service).append(item_div);
                        }
                    }
                    $("#tools>div.group>div.analyze>div,#tools>div.group>div.omatome>div").each(function(){
                        var tool_obj = this;
                        var toolid = $(tool_obj).attr("data-toolid");
                        var service = $(tool_obj).attr("data-service");
                        var selected_toolid = (ninjatools.options.services[service]) ? ninjatools.options.services[service].toolid:null;

                        if (toolid == selected_toolid) {
                            var place = ninjatools.options.services[service].place;
                            $(tool_obj).attr("data-dropped_area", "1");
                            //$(tool_obj).appendTo("." + place).css('top', '0px').css('left','0px');
                            $(tool_obj).appendTo("." + place).addClass("dropped");
                            $(tool_obj).find(".handle_div").removeClass("handle_div").addClass("close_div").click(function(){
                                var service = $(tool_obj).attr("data-service");
                                ninjatools.delTool(service);
                                $(this).removeClass("close_div").addClass("handle_div");
                                $(tool_obj).removeAttr("data-dropped_area");
                                $(tool_obj).appendTo("#tools>div.group>div."+service).draggable('enable');
                            });
                            $(tool_obj).draggable('disable');
                        }
                    });


                    $("#tools").accordion({
                        header: "> div > h3"
                    }).sortable({
                        axis: "y",
                        handle: "h3",
                        stop: function( event, ui ) {
                            ui.item.children( "h3" ).triggerHandler( "focusout" );
                        }
                    });

                }else{
                    $("#nt_msg").text("<?php _e("Invalid infomation.", NINJATOOLS_DOMAIN);?>");
                    $(".ninjatools_admin .updated").show();
                    setTimeout(function(){
                        $(".ninjatools_admin .updated").fadeOut("slow");
                    }, 4000);
                    $(".ninjatools_admin .login").show("fast");
                }
            }
        });
    };

    this.getCredential = function() {
        var id = jQuery("#nt_id").val();
        var ps = jQuery("#nt_ps").val();
        if (!id || !ps) {
            return;
        }
        $(".ninjatools_admin .login").hide("slow", function(){
            $.ajax({
                type: 'POST',
                dataType: "json",
                cache: false,
                async: false,
                data: {
                    "action": NINJATOOLS_ADMIN.action,
                    "query": {
                        action: "getCredential",
                        id: id,
                        ps: ps
                    }
                },
                url: NINJATOOLS_ADMIN.endpoint,
                context: this,
                success: function (data) {
                    //initialize
                    $("div.article,div.footer,div.sidebar").find("div[data-toolid]").each(function(){
                        $(this).remove();
                    });

                    if (data.result == false) {
                        $("#nt_msg").text("<?php _e("Invalid infomation.", NINJATOOLS_DOMAIN);?>");
                        $(".ninjatools_admin .updated").show();
                        setTimeout(function(){
                            $(".ninjatools_admin .updated").fadeOut("slow");
                        }, 4000);
                        $(".ninjatools_admin .login").show("fast");
                    }else{
                        $("#nt_msg").text("<?php _e("Logged in successfully.", NINJATOOLS_DOMAIN);?>");
                        $(".ninjatools_admin .updated").show();
                        setTimeout(function(){
                            $(".ninjatools_admin .updated").fadeOut("fast");
                        }, 3000);

                        ninjatools.getTools();
                    }
                }
            });
        });
    };

}

var ninjatools = new NINJATOOLS();
(function($,d) {
    $(d).ready(function(){
        //init design
        var fixed = 30;
        var init = $("#wpbody-content").height();
        function auto_resize(){
            var height = $(window).height();
            var area = init + fixed;
            if (height > area) {
                $("#wpbody-content").css("height", height - fixed);
            }
        }
        auto_resize(); 

        $(window).resize(function(){
            auto_resize();
        });
        //init design end



        $("#nt_login").click(function(e){
            ninjatools.getCredential();
        });

        ninjatools.getOption();
        //console.log(ninjatools.options);

        if (ninjatools.options.public_key) {
            ninjatools.getTools();
        }else{
            $("#nt_msg").text("<?php _e("Click login button below, and Input ID&Password for Ninja Tools", NINJATOOLS_DOMAIN);?>");
            $(".ninjatools_admin .updated").show();
            $(".ninjatools_admin .ntwpp_memo").hide();
            $("#tools").html("");
        }

        var isAccept = function(){
            var place = $(this).attr("data-place");
            var obj = ninjatools.getDraggingObj();
            var analyze_divnum = 0;
            var omatome_divnum = 0;
            $(".layout").find("div[data-service='analyze']").each(function(){
                analyze_divnum++;
            });
            $(".layout").find("div[data-service='omatome']").each(function(){
                omatome_divnum++;
            });
            var obj_service = $(obj).attr("data-service");

            if (obj_service == "analyze") {
                if (place == 'article'|| analyze_divnum || ninjatools.options.services.analyze && ninjatools.options.services.analyze.toolid) {
                    return false;
                }
            } else if (obj_service == "omatome") {
                if (place == 'footer' || omatome_divnum || ninjatools.options.services.omatome && ninjatools.options.services.omatome.toolid) {
                    return false;
                }
            }

            return true;
        };

        var onDrop = function(e, ui){
            var tool_obj = ui.draggable.context;
            $(tool_obj).attr("data-dropped_area", "1");
            $(tool_obj).appendTo(this).addClass("dropped");
            setTimeout(function(){
                $(tool_obj).find(".handle_div").removeClass("handle_div").addClass("close_div").click(function(){
                    var service = $(tool_obj).attr("data-service");
                    ninjatools.delTool(service);
                    $(this).removeClass("close_div").addClass("handle_div");
                    $(tool_obj).removeAttr("data-dropped_area");
                    $(tool_obj).appendTo("#tools>div.group>div."+service).draggable('enable');
                });
            }, 1000);
            $(tool_obj).draggable('disable');
            tool_obj.style.left = "";
            tool_obj.style.top= "";

            var service = $(tool_obj).attr("data-service");
            var toolid = $(tool_obj).attr("data-toolid");
            var toolname = $(tool_obj).attr("data-toolname");
            var place = $(this).attr("data-place");
            ninjatools.setTool(service, toolid, toolname, place);
        };

        $(".sidebar,.footer,.article").droppable({
            hoverClass: 'drophover',
            accept: isAccept,
            drop: onDrop
        });

    });
})(jQuery, document);

