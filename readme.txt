=== ninjatools ===
Contributors: ninjatools
Donate link:
Tags: widget, sidebar, footer, ninjatools, analysis, analytics, social, social media, twitter, facebook, google
Requires at least: 3.5
Tested up to: 4.2.4
Stable tag: 1.2.4

This plugin inserts HTML code of "Ninja Tools" for analyzing visitors, or setting up social buttons in your blog without complex procedure.

== Description ==

 This plugin inserts HTML code of "Ninja Tools" for analyzing visitors, or setting up social buttons in your blog without complex procedure. You can setup Ninja Tools widgets easily in your wordpress only few steps.  
 Ninja Tools id/password which you have entered is not saved in database. These Information is transformed to safe read only form which called "public key". After that, this plugin communicates with Ninja Tools API using the public key. These Communication with Ninja Tools API is encrypted by SSL.  
 Once authenticated, you can get the list of "Ninja Analyze" and "Ninja Omatome Button". Then, choose the one from "Ninja Analyze" or "Ninja Omatome Button", and drag the tool, drop it on right side where you want setup it (now, you can select sidebar area or footer area only). The Ninja Tools widget works.  
  
 このプラグインはサイトを訪れた人を分析する「忍者ツールズ」の「忍者アナライズ」やソーシャルメディアへの発信を手助けする「忍者おまとめボタン」を複雑な手続き無しであなたのWordPressにわずか数ステップで設置することができます。  
 あなたが入力した忍者ツールズのID/パスワードはデータベースに保存せず、暗号化され安全に保存されます。 また、忍者ツールズとの通信は暗号化されたSSL通信で行ないます。  
 ログインした後は、「忍者アナライズ」と「忍者おまとめボタン」のリストを自動的に取得します。 そして、必要なツールをドラッグアンドドロップで簡単にセットアップすることができます。  

== Installation ==

1. Upload this directory to the `/wp-content/plugins/` directory
   (`/wp-content/plugins/` ディレクトリ（フォルダ）にこのプラグインをアップロードします。)
2. Activate the plugin through the 'Plugins' menu in WordPress
   (WordPress管理画面左メニューの「プラグイン」より「NinjaTools」を選択し「有効化」をクリックします。)
3. Open 'Ninja Tools Options' control panel through the 'Settings' menu
   (WordPress管理画面左メニューの「設定」より「忍者ツールズ」を選択し開きます。)

== Frequently Asked Questions ==

= A question that someone might have =
  * [Ninja Analyze](http://www.ninja.co.jp/analysis/help/faq/#faq)
  * [Ninja Omatome Button](http://www.ninja.co.jp/omatome/help/faq/#faq)

= よくある質問 =
  * [忍者アナライズ](http://www.ninja.co.jp/analysis/help/faq/#faq)
  * [忍者おまとめボタン](http://www.ninja.co.jp/omatome/help/faq/#faq)

== Screenshots ==

1. At the first, input your Ninja Tools id, password.
  (忍者ツールズID、パスワードを入力して送信します。)
2. You get the list of "Ninja Analyze" and "Ninja Omatome Button". Drag your Ninja Tools widget listed on left side, and drop it on right side.
  (あなたの忍者アナライズと忍者おまとめボタンのリストが表示され、ウィジットをドラッグで右の枠内にドロップします。)
3. Setup is completed. The Ninja Tools widget works.
  (以上でセットアップは完了です。)

== Changelog ==

= 1.2.4 =
* change connection `file_get_contents` -> `curl`

= 1.2.2 =
* fix cannot show omatome button lists

= 1.2.1 =
* reset version

= 1.2.0 =
* reset version

= 1.1.1 =
* Added check array/object number

= 1.1.0 =
* Added "Ninja Omatome Button"

= 1.0.0 =
* First Release

== Upgrade Notice ==

= 1.2.4 =
* change connection `file_get_contents` -> `curl`

= 1.2.2 =
* fix cannot show omatome button lists

= 1.2.1 =
* reset version

= 1.2.0 =
* reset version

= 1.1.1 =
* Added check array/object number

= 1.1.0 =
* Added "Ninja Omatome Button"
