<script type="text/javascript">
<!--
<?php require_once(NINJATOOLS_PLUGIN_DIR . "/ninjatools_admin.js.php"); ?>
-->
</script>
<style type="text/css">
  <!--
  <?php require_once(NINJATOOLS_PLUGIN_DIR . "/ninjatools_admin.css.php"); ?>
  -->
</style>

<div class="ntwpp_tools_block">

  <div class="ninjatools_admin_title">
    <h2><img src="<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_logo.png" width="220" height="54" alt="Ninja Tools Wordpress Plugin"></h2>
  </div>

  <div class="ninjatools_admin">
    <div class="updated">
      <p>
        <strong id="nt_msg"></strong>
      </p>
    </div>

    <div class="ntlogin" onclick="ninjatools.showLogin();">
      <img src="<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_login.png" width="82" height="17"><?php _e("Login", NINJATOOLS_DOMAIN); ?>
    </div>

    <div class="login">
      <div class="form">
        <input type="button" onclick="jQuery('.ninjatools_admin .login').fadeOut('fast');" value="X" class="btn02">
        <div class="nt_username"><?php _e("Username", NINJATOOLS_DOMAIN); ?></div>
        <div class="nt_inputid"><input id="nt_id" type="text" value=""></div>
        <div class="clear"></div>

        <div class="nt_password"><?php _e("Password", NINJATOOLS_DOMAIN); ?></div>
        <div class="nt_inputps"><input id="nt_ps" type="password" value=""></div>
        <div class="clear"></div>

        <div class="submit">
          <input id="nt_login" type="button" value="<?php _e("Send", NINJATOOLS_DOMAIN); ?>" class="btn">
        </div>
        <div class="clear"></div>
      </div>
    </div>

    <div class="select_tool">
      <div class="ntwpp_memo">
        <img src="<?php echo NINJATOOLS_PLUGIN_URL; ?>/images/nt_wpp_memo01.png" width="259" height="28">
      </div>

      <div id="tools">
        <h3 class="subti_na_oma">
          <span><?php _e("Ninja Omatome", NINJATOOLS_DOMAIN); ?></span><span class="nomal"><?php _e("Tool List", NINJATOOLS_DOMAIN); ?></span>
        </h3>
        <div class="omatome"></div>
        <div class="last_line"></div>

        <h3 class="subti_na_ana">
          <span><?php _e("Ninja Analyze", NINJATOOLS_DOMAIN); ?></span><span class="nomal"><?php _e("Tool List", NINJATOOLS_DOMAIN); ?></span>
        </h3>
        <div class="analyze"></div>
        <div class="last_line"></div>
      </div>

      <div class="clear"></div>
    </div>
  </div>
</div>
<!-- /nt_wp_tools -->


<div class="ninjatools_admin">
  <div class="layout">
    <div class="outline">
      <div class="header disabled">
        <div class="title"><?php _e("Header", NINJATOOLS_DOMAIN); ?></div>
      </div>
      <div class="article ui-droppable" data-place="article">
        <div class="title"><?php _e("Article", NINJATOOLS_DOMAIN); ?></div>
      </div>
      <div class="sidebar ui-droppable" data-place="sidebar">
        <div class="title"><?php _e("Sidebar", NINJATOOLS_DOMAIN); ?></div>
      </div>
      <div class="clear"></div>

      <div class="footer ui-droppable" data-place="footer">
        <div class="title"><?php _e("Footer", NINJATOOLS_DOMAIN); ?></div>
      </div>
    </div>
  </div>
</div>
<!-- /ninjatools_admin -->
