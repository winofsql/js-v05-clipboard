// *************************************
// jQuery プラグイン
// *************************************
var clipbpardText = "";
var clipboard;
$(function(){

    // **********************************************
    // テーブルデータ用クリップボード処理オブジェクト
    // **********************************************
    clipboard = new ClipboardJS('.clip-btn' , {
        text: function(trigger) {
            // clipboard.js に渡す( このデータがクリップポードに転送される )
            return clipbpardText;
        }
    });

    // **********************************************
    // クリップボードへの転送に成功した時に
    // 実行されるイベント( 無くても良い )
    // **********************************************
    clipboard.on('success', function(e) {
        alert("テーブルデータをクリップボードにコピーしました");
    });

    $("#save").on("click", function(){
        // **********************************************
        // clipbpardText にクリップボードに転送したい文字列をセットする
        // **********************************************
        var work = "";

        $("table tr").each( function( row_cnt ){

            $(this).find("td,th").each(function( col_cnt ){
                if ( col_cnt != 0 ) {
                    work += "\t";
                }
                work += $(this).text();

            });
            work += "\r\n";

        });

        clipbpardText = work;
    })

    // **************************************
    // テーブルに対する処理
    // **************************************
    $("#tbl-main tr").each(function(idx){

        // **************************************
        // データ部分のフォーマットと右寄せ
        // **************************************
        $(this).find("td").each(function(idx){

            switch( idx ) {
                case 7:
                    $(this).css({"text-align": "right" });
                    $(this).text( ($(this).text()).number_format() );
                    break;
                case 8:
                    $(this).css({"text-align": "right" });
                    $(this).text( ($(this).text()).number_format() );
                    break;
            }

        });

        // **************************************
        // タイトル部分の右寄せ
        // **************************************
        $(this).find("th").each(function(idx){

            switch( idx ) {
                case 7:
                    $(this).css({"text-align": "right" });
                    break;
                case 8:
                    $(this).css({"text-align": "right" });
                    break;
            }

        });

    });

});
