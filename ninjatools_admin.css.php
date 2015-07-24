html,body {
    height: 100% !important;
}

#wpbody-content {
    padding-bottom: 0 !important;
}

.wrapper{
    min-width:760px;
    width:760px;
}

.ntwpp_tools_block{
    background:#403C3B;
    width:265px;
    padding:13px 0 0x;
    margin:0 0 0 -19px;
    color:#FFF;
    float:left;
    border-top:1px solid #555;

    -webkit-box-shadow: 1px 1px 1px 1px rgba(200, 200, 200, 0.5);
    box-shadow: 1px 1px 1px 1px rgba(200, 200, 200, 0.5);

    height: auto !important;    
    height: 100%;
    min-height: 100%;
}

.ntwpp_tools_block h3 {
    color: #fff !important;
}

.ninjatools_admin_title h2{
    padding:12px 0 2px 20px;
}

.ntlogin{
    border-top:1px solid #666;
    border-bottom:1px solid #555;
    text-indent:102px;
    padding:9px 5px 10px;
    margin:0 0 6px 0;
    color:#DDD;
    position:relative;

    background:
    -moz-linear-gradient(
    top,
    #555 0%,
    #403C3B);
    background:
    -webkit-gradient(
    linear, left top, left bottom, 
    from(#555),
    to(#403C3B));
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#555555', endColorstr='#403C3B') !important; /* IE6 & IE7 */
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#555555', endColorstr='#403C3B')" !important; /* IE8 */
    zoom: 1;

    -webkit-box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.7);
    -moz-box-shadow:    0px 0px 1px rgba(0, 0, 0, 0.7);
    box-shadow:         0px 0px 1px rgba(0, 0, 0, 0.7);
}
.ntlogin img{
    z-index:1;
    position:absolute;
    top:8px;
    left:22px;
}

.ntlogin:hover{
    opacity:0.8;
    -ms-filter: "alpha( opacity=80 )";
    cursor: pointer;
}



.close_div {
    background-color: white;
    float: left;
    cursor: pointer;
    margin: 0 4px 0 1px;
    width: 15px;
    text-align: center;
}

.ntwpp_memo{
    padding:0 0 3px 20px;
    margin:0;
}

.ninjatools_admin .select_tool .clear{ 
    clear: both;
}

.ninjatools_admin .select_tool .ntlogin{
    cursor: pointer;
}


.ninjatools_admin .updated{
    background:#e6ff81;
    display: none; 
    margin:5px 12px 12px;
    padding:2px 8px;
    border:none;
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
}


/*  login block */
.ninjatools_admin .login {
    padding: 15px;
    display: none;
    border-left:1px solid #555;
    width: 430px;
    position:absolute;
    background:#403C3B;
    left:246px;
    top:101px;
    z-index: 9999;
}
.ninjatools_admin .login p {
    border : 1px solid red
}

.ninjatools_admin .login .form {
    margin: 0px;
}

.nt_username{
    float:left;
    width:90px;
    padding:5px 0 5px 0;
    font-size:11px;
    color:#FFF;
}
.nt_password{
    float:left;
    width:90px;
    padding:5px 0 5px 0;
    font-size:11px;
    color:#FFF;
}
.nt_inputid{
    height:38px;
}

.ninjatools_admin .login .form .nt_inputid input{
    font-size: 100%;
    width: 300px;
    line-height: 1;
    padding: 3px 8px;
    background:#F0F0F0;
    border-radius: 0px;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
}

.ninjatools_admin .login .form .nt_inputps input{
    font-size: 100%;
    width: 300px;
    line-height: 1;
    padding: 3px 8px;
    background:#F0F0F0;
    border-radius: 0px;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
}

.ninjatools_admin .login .form .submit{
    padding-top: 15px;
}
.ninjatools_admin .login .form .submit input{
    padding: 5px;
}

.ninjatools_admin .login .form .clear{
    clear: both;
}

.btn{
    border: 1px solid #cccacc;

    background: -moz-linear-gradient(
    top,
    #FFFFFF 0%,
    #E2E3E5);
    background: -webkit-gradient(
    linear, left top, left bottom, 
    from(#FFFFFF),
    to(#E2E3E5));
    filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#FFFFFF', endColorstr='#E2E3E5'); /* IE6 & IE7 */
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#FFFFFF', endColorstr='#E2E3E5')"; /* IE8 */
    zoom: 1;

    -moz-box-shadow: 0px 0px 5px #000;
    -webkit-box-shadow: 0px 0px 5px #000;
    box-shadow: 0px 0px 5px #000;
    -ms-box-shadow: 0px 0px 5px #000;

    text-shadow:
    0px -1px 0px rgba(100,100,100,0.1),
    0px 1px 0px rgba(100,100,100,0.1);

    text-align:center;
    text-decoration: none;
    display:block;
    font-size:11px;
    width:120px;
    padding:10px 12px 0;
    margin:-5px 5px 3px 90px;
    color:#000;
    float:left;
}
.btn02{
    background:#000;
    border:none;
    margin:-15px -15px 0 0;
    z-index:1;
    float:right;
    color:#EEE;
    font-size:12px;
    height:25px;
    width:28px;
    text-align:center;
    vertical-align:central;
    cursor: pointer;
}

.btn:hover{
    opacity:0.8;
    -ms-filter: "alpha( opacity=80 )";
    cursor: pointer;
}

.layout{
    border: 1px solid #C7C7C7;
    width: 501px;
    padding: 0;
    margin:27px 0 10px 30px;
    float: left;
    font-size:11px;
}

.ninjatools_admin .clear{
    clear: both;
}
.ninjatools_admin .title{
    color: gray;
    padding: 5px;
}

.ninjatools_admin .header{
    border-bottom: 1px dotted #C7C7C7;
    width: 100%;
    margin: 0;

}

.ninjatools_admin .article{
    width: 250px;
    float: left;
    margin: 0;
    height: 260px;
}
.ninjatools_admin .sidebar{
    border-left: 1px dotted #C7C7C7;
    width: 250px;
    float: right;
    margin: 0;
    height: 260px;
}
.ninjatools_admin .footer{
    border-top: 1px dotted #C7C7C7;
    width: 100%;
    margin: 0;
    height: 80px;
}

.dragging.analyze {
    background: #FFF url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool03.png) no-repeat center center;
}

.dragging.omatome {
    background: #FFF url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool03.png) no-repeat center center;
}

.ninjatools_admin .drophover {
    background: #F9FFE4 url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool03.png) no-repeat center center;
}

#tools{
    width: 220px;
    float: left;
    padding: 0 0 15px 20px;
    margin:0;
}


#tools div.item{
    float: left;
    width :210px;
    color:#555;
    margin: 2px;
    border: 1px solid #555;

    -webkit-box-shadow: 0px 0px 1px rgba(0, 0, 0, 1);
    -moz-box-shadow:    0px 0px 1px rgba(0, 0, 0, 1);
    box-shadow:         0px 0px 1px rgba(0, 0, 0, 1);
}

#tools div.item.analyze{
    background:url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_analyze.png) no-repeat 3px 4px #FFF;
    text-indent:20px;
}


#tools div.item.omatome{
    background:url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_omatome.png) no-repeat 3px 4px #FFF;
    text-indent:20px;
}


#tools div.title_div{
    float: left;
    width :170px;
    color:#555;
    overflow: hidden;
    padding:5px 5px 4px 5px;
}

#tools div.handle_div{
    float: left;
    width :30px;
    height: 26px;
    margin: 0;
    padding: 0;
    cursor: move;
}

#tools div.handle_div.analyze{
    background: #FFF url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool01.png) no-repeat right center ;
}

#tools div.handle_div.omatome{
    background: #FFF url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool01.png) no-repeat right center ;
}

#tools div.clear{
    clear: both;
}

#tools .group h3:hover{
    cursor: move;
}

#tools .group .subti_na_oma{
    font-size:11px;
    font-weight:bold;
    line-height:1;
    text-indent:44px;
       cursor: pointer;
    
       margin:2px -20px 3px;
       border-top:1px solid #666;
       padding:14px 0 5px;
       width:265px;
       clear:both;
    
                background: url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_omatome.png) no-repeat 20px 10px;
       background:
                url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_omatome.png) no-repeat 20px 10px,
    -moz-linear-gradient(
    top,
    #555 0%,
    #403C3B);
    background:
                url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_omatome.png) no-repeat 20px 10px,
    -webkit-gradient(
    linear, left top, left bottom, 
    from(#555),
    to(#403C3B));
}

#tools .group .subti_na_ana{
    font-size:11px;
    font-weight:bold;
    line-height:1;
    text-indent:44px;
       cursor: pointer;
                
    margin:2px -20px 3px;
       border-top:1px solid #666;
       padding:14px 0 5px;
       width:265px;
       clear:both;
    
                background:url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_analyze.png) no-repeat 20px 10px ;
       background:
                url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_analyze.png) no-repeat 20px 10px,
    -moz-linear-gradient(
    top,
    #555 0%,
    #403C3B);
    background:
                url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_analyze.png) no-repeat 20px 10px,
    -webkit-gradient(
    linear, left top, left bottom, 
    from(#555),
    to(#403C3B));
}


.group{
}

.last_line{
       clear:both;
    margin:0 -20px 0;
                padding:6px 0 0;
                border-bottom:1px solid #666;
       width:265px;
                height:0;
}

.nomal{
    font-weight:normal;
}

.ninjatools_admin .layout .outline div.item{
    float: left;
    width :210px;
    background: #FFF url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool02.png) no-repeat right center ;
    color:#000;
    margin: 2px;
    border: 1px solid #999;

    -webkit-box-shadow: 0px 0px 1px rgba(0, 0, 0, 1);
    -moz-box-shadow:    0px 0px 1px rgba(0, 0, 0, 1);
    box-shadow:         0px 0px 1px rgba(0, 0, 0, 1);


}


.ninjatools_admin .layout .outline .article .dropped{
    position: relative;
    left: 15px;
    top: 5px;  
}


.ninjatools_admin .layout .outline .sidebar .dropped{
    position: relative;
    left: 15px;
    top: 5px;  
}


.ninjatools_admin .layout .outline .footer .dropped{
    position: relative;
    left: 145px;
    top: 0px;   
}

.ninjatools_admin .layout .outline div.title_div{
    float: left;
    width :170px;
    color:#555;
    overflow: hidden;
    padding:5px 5px 4px 5px;
}

.ninjatools_admin .layout .outline div.title_div.analyze{
    background:url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_analyze.png) no-repeat 3px 4px #FFF;
    text-indent:20px;
}
.ninjatools_admin .layout .outline div.title_div.omatome{
    background:url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/ico_omatome.png) no-repeat 3px 4px #FFF;
    text-indent:20px;
}

.ninjatools_admin .layout .outline div.close_div{
    float: left;
    width :30px;
    height: 26px;
    background: #FFF url(<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_tool02.png) no-repeat right center ;
    margin: 0;
    padding: 0;
    cursor: pointer;
}

.ninjatools_admin .layout .outline div.clear{
    clear: both;
}


.ninjatools_admin .ntlogin{
    cursor: pointer;
}


.ninjatools_admin .toolname{
    margin-left: 3em;
    margin-bottom: 3em;

}
#nt_msg {
    color: black;
}



#wpfooter {
    position: absolute;
    bottom: 0;
    left: 278px;
    right: 0;
    padding: 8px 0;
    margin-right: 20px;
    border-top-width: 1px;
    border-top-style: solid;
    font-size:10px;
}
