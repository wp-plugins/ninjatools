function NINJATOOLS(){
    var $ = jQuery;
    var d = document;

    this.options = null;
    this.showLogin = function() {
        $(".ninjatools_admin .login").fadeIn();
    };
    this.delTool = function() {
        $.ajax({
            type: 'POST',
            dataType: "json",
            cache: false,
            //async: false,
            data: {
                "action": NINJATOOLS_ADMIN.action,
                "query": {
                    action: "delTool",
                    deactivate: true,
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
    this.setTool = function(toolid, toolname, place) {
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
                    //console.log(data);
                    ninjatools.options = data.options;

                    $("#tools").html("");
                    if (data.tool_list == false) {
                        $("#tools").text("<?php _e("No available tools. Please create tool after sign in Ninja Tools, or use another Ninja Tools account.", NINJATOOLS_DOMAIN);?>");
                    }else{
                        $(".ninjatools_admin .ntwpp_memo").show();
                        var h4 = $(d.createElement('h4')).text('<?php _e("Ninja Analyze Tool List", NINJATOOLS_DOMAIN);?>').addClass("subti_na");
                        $("#tools").append(h4);
                    }
                    for (tool in data.tool_list) {
                        var title_div = $(d.createElement('div')).addClass("title_div").text(data.tool_list[tool]);
                        var handle_div = $(d.createElement('div')).addClass("handle_div");
                        var clear_div = $(d.createElement('div')).addClass("clear");

                        var item_div = $(d.createElement('div')).attr("data-toolid", tool).attr("data-toolname", data.tool_list[tool]).addClass("item").append(title_div).append(handle_div).append(clear_div).draggable({
                            handle: ".handle_div",
                            start: function(e, ui){
                                $(".sidebar,.footer").addClass("dragging");
                            },

                            stop: function(){
                                $(".sidebar,.footer").removeClass("dragging");
                                if ($(this).attr("data-dropped_area") != "1") {
                                    $(this).css("left", "0").css("top", "0");
                                }
                            }
                        });
                        $("#tools").append(item_div);
                    }
                    $("#tools>div").each(function(){
                        var tool_obj = this;
                        var toolid = $(tool_obj).attr("data-toolid");
                        var selected_toolid = (ninjatools.options.services.analyze) ? ninjatools.options.services.analyze.toolid:null;
                        if (toolid == selected_toolid) {
                            var place = ninjatools.options.services.analyze.place;
                            $(tool_obj).attr("data-dropped_area", "1");
                            //$(tool_obj).appendTo("." + place).css('top', '0px').css('left','0px');
                            $(tool_obj).appendTo("." + place).addClass("dropped");
                            $(tool_obj).find(".handle_div").removeClass("handle_div").addClass("close_div").click(function(){
                                ninjatools.delTool();
                                $(this).removeClass("close_div").addClass("handle_div");
                                $(tool_obj).removeAttr("data-dropped_area");
                                $(tool_obj).appendTo("#tools").draggable('enable');
                            });
                            $(tool_obj).draggable('disable');
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
            var divnum = 0;
            $(this).children().each(function(){
                if(!$(this).hasClass("title")) {
                    divnum++;
                    return false;
                }
            });
            if (divnum || ninjatools.options.services.analyze && ninjatools.options.services.analyze.toolid) {
                return false;
            }
            return true;
        };

        var onDrop = function(e, ui){
            var tool_obj = ui.draggable.context;
            $(tool_obj).attr("data-dropped_area", "1");
            $(tool_obj).appendTo(this).addClass("dropped");
            setTimeout(function(){
                $(tool_obj).find(".handle_div").removeClass("handle_div").addClass("close_div").click(function(){
                    ninjatools.delTool();
                    $(this).removeClass("close_div").addClass("handle_div");
                    $(tool_obj).removeAttr("data-dropped_area");
                    $(tool_obj).appendTo("#tools").draggable('enable');
                });
            }, 1000);
            $(tool_obj).draggable('disable');
            tool_obj.style.left = "";
            tool_obj.style.top= "";

            var toolid = $(tool_obj).attr("data-toolid");
            var toolname = $(tool_obj).attr("data-toolname");
            var place = $(this).attr("data-place");
            ninjatools.setTool(toolid, toolname, place);
        };

        $(".sidebar,.footer").droppable({
            hoverClass: 'drophover',
            accept: isAccept,
            drop: onDrop
        });

    });
})(jQuery, document);

