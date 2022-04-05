<!DOCTYPE html>
<html>
<head>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta charset="utf-8">
<title>クリップボード</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>

<script src="client.js?_=<?= time() ?>"></script>

<script>
// *************************************
// 簡易スマホチェック
// *************************************
jQuery.isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));

// ***********************
// カンマ編集
// ***********************
String.prototype.number_format = 
function (prefix) {
    var num = this.valueOf();
    prefix = prefix || '';
    num += '';
    var splitStr = num.split('.');
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? '.' + splitStr[1] : '';
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + ',' + '$2');
    }
    return prefix + splitLeft + splitRight;
}
// ***********************
// カンマ編集削除
// ***********************
String.prototype.remove_number_format = 
function () {
    var num = this.valueOf();
    return num.replace(/([^0-9\.\-])/g, '');
}
</script>

<style>
th {
    position: sticky;
    top: 0;
    background-color: #c0c0c0!important;
}
th:first-child {
    position: sticky;
    left: 0;
    z-index: 2;
}
td:first-child {
    position: sticky;
    left: 0;
    z-index: 1;
    background-color: #ffffff!important;
}
/* ****************************
1) 列のカーソルは常に矢
2) 改行コードを有効
******************************/
td,th {
    cursor: default!important;
    white-space: pre;
}

body {
    margin: 0;
}

/* ****************************
テーブル内のデータを選択不可
( ダブルクリック対応 )
******************************/
#tbl-main {
    user-select: none;
}

table {
    margin-top: 36px;
}

@media screen and ( min-width:480px ) {

    #main {
        padding: 16px;
    }
}

@media screen and ( max-width:479px ) {

    #main {
        padding: 0px;
    }
    h3 {
        padding: 15px;
        background-color: black;
        color: white;
    }
    body {
        padding: 0;
    }

}

</style>
</head>
<body>
<h3 class="alert alert-primary"><a href="control.php">クリップボード</a></h3>
<div id="main">

    <h3>メイン画面 <input type="button" class="btn btn-secondary ms-4 clip-btn" value="コピー" id="save"></h3>

    <div class="table-responsive" style='overflow-x:visible'>
    <table class="table table-hover">
        <!-- bootstrap 対応の為、tbody に対して処理 -->
        <tbody id="tbl-main">
            <th>社員コード</th><th>氏名</th><th>フリガナ</th><th>所属</th><th>性別</th><th>作成日</th><th>更新日</th><th>給与</th><th>手当</th><th>管理者</th><th>生年月日</th>
            <tr><td>0001</td><td>山田 太郎</td><td>ウラオカ トモヤ</td><td>0003</td><td>0</td><td>2005-09-12</td><td>2005-11-28</td><td>400000</td><td>9000</td><td>0001</td><td>2012/03/21</td></tr>
            <tr><td>0002</td><td>山村 洋代</td><td>ヤマムラ ヒロヨ</td><td>0003</td><td>1</td><td>2005-06-17</td><td>2005-09-18</td><td>300000</td><td></td><td>0001</td><td>2001/01/02</td></tr>
            <tr><td>0003</td><td>多岡 冬行</td><td>タオカ フユユキ</td><td>0002</td><td>0</td><td>2005-08-14</td><td>2005-11-14</td><td>250000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0004</td><td>高田 冬美</td><td>タカタ フユミ</td><td>0003</td><td>1</td><td>2005-06-13</td><td>2005-10-05</td><td>250000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0005</td><td>内高 友之</td><td>ウチタカ トモユキ</td><td>0003</td><td>0</td><td>2005-09-12</td><td>2005-11-10</td><td>150000</td><td></td><td></td><td>2001/01/01</td></tr>
            <tr><td>0006</td><td>森尾 正也</td><td>モリオ マサヤ</td><td>0002</td><td>0</td><td>2005-08-14</td><td>2005-12-17</td><td>300000</td><td>7000</td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0007</td><td>鈴杉 由樹</td><td>スズスギ ヨシキ</td><td>0001</td><td>0</td><td>2005-07-12</td><td>2005-10-03</td><td>170000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0008</td><td>川吉 洋樹</td><td>カワヨシ ヒロキ</td><td>0002</td><td>0</td><td>2005-08-15</td><td>2005-12-14</td><td>240000</td><td></td><td>0004</td><td>2001/01/01</td></tr>
            <tr><td>0009</td><td>村森 友恵</td><td>ムラモリ トモエ</td><td>0003</td><td>1</td><td>2005-09-11</td><td>2005-11-06</td><td>290000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0010</td><td>杉岡 友一</td><td>スギオカ トモカズ</td><td>0002</td><td>0</td><td>2005-08-17</td><td>2005-09-18</td><td>180000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0011</td><td>川多 由男</td><td>カワタ ヨシオ</td><td>0002</td><td>0</td><td>2005-08-19</td><td>2005-11-15</td><td>230000</td><td>5000</td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0012</td><td>杉岡 由樹</td><td>スギオカ ヨシキ</td><td>0002</td><td>0</td><td>2005-06-29</td><td>2005-11-12</td><td>280000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0013</td><td>木川 元男</td><td>キカワ モトオ</td><td>0001</td><td>0</td><td>2005-07-21</td><td>2005-11-18</td><td>230000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0014</td><td>川木 春一</td><td>カワキ ハルカズ</td><td>0001</td><td>0</td><td>2005-07-04</td><td>2005-12-15</td><td>230000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0015</td><td>中多 克也</td><td>ナカタ カツヤ</td><td>0001</td><td>0</td><td>2005-09-04</td><td>2005-11-11</td><td>160000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0016</td><td>森村 正恵</td><td>モリムラ マサエ</td><td>0001</td><td>1</td><td>2005-07-07</td><td>2005-10-08</td><td>150000</td><td>5000</td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0017</td><td>尾田 雅也</td><td>オタ マサヤ</td><td>0002</td><td>0</td><td>2005-09-09</td><td>2005-10-31</td><td>170000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0018</td><td>松中 輝行</td><td>マツナカ テルユキ</td><td>0001</td><td>0</td><td>2005-07-11</td><td>2005-10-24</td><td>300000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0019</td><td>野丸 由一</td><td>ノマル ヨシカズ</td><td>0001</td><td>0</td><td>2005-06-05</td><td>2005-09-26</td><td>140000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0020</td><td>松野 友之</td><td>マツノ トモユキ</td><td>0003</td><td>0</td><td>2005-07-08</td><td>2005-11-24</td><td>300000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0021</td><td>吉村 春一</td><td>ヨシムラ ハルカズ</td><td>0002</td><td>0</td><td>2005-06-23</td><td>2005-11-06</td><td>210000</td><td>8000</td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0022</td><td>丸吉 春代</td><td>マルヨシ ハルヨ</td><td>0001</td><td>1</td><td>2005-08-15</td><td>2005-09-28</td><td>230000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0023</td><td>松本 洋也</td><td>マツモト ヒロヤ</td><td>0003</td><td>0</td><td>2005-06-30</td><td>2005-11-14</td><td>270000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0024</td><td>尾木 輝男</td><td>オキ テルオ</td><td>0003</td><td>0</td><td>2005-08-06</td><td>2005-10-29</td><td>160000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0025</td><td>鈴川 春美</td><td>スズカワ ハルミ</td><td>0001</td><td>1</td><td>2005-07-28</td><td>2005-11-27</td><td>260000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0026</td><td>原中 元美</td><td>ハラナカ モトミ</td><td>0001</td><td>1</td><td>2005-08-01</td><td>2005-10-23</td><td>180000</td><td>10000</td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0027</td><td>浦村 春一</td><td>ウラムラ ハルカズ</td><td>0002</td><td>0</td><td>2005-06-10</td><td>2005-09-25</td><td>240000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0028</td><td>森木 和之</td><td>モリキ カズユキ</td><td>0002</td><td>0</td><td>2005-07-26</td><td>2005-12-20</td><td>170000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0029</td><td>多田 友行</td><td>タタ トモユキ</td><td>0003</td><td>0</td><td>2005-07-19</td><td>2005-12-13</td><td>250000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0030</td><td>浦川 冬代</td><td>ウラカワ フユヨ</td><td>0001</td><td>1</td><td>2005-08-22</td><td>2005-10-15</td><td>270000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0031</td><td>岡中 冬之</td><td>オカナカ フユユキ</td><td>0003</td><td>0</td><td>2005-07-07</td><td>2005-12-13</td><td>280000</td><td>7000</td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0032</td><td>野尾 春男</td><td>ノオ ハルオ</td><td>0001</td><td>0</td><td>2005-08-28</td><td>2005-11-03</td><td>200000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0033</td><td>田杉 洋也</td><td>タスギ ヒロヤ</td><td>0003</td><td>0</td><td>2005-08-07</td><td>2005-10-15</td><td>270000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0034</td><td>村高 洋代</td><td>ムラタカ ヒロヨ</td><td>0002</td><td>1</td><td>2005-06-19</td><td>2005-11-11</td><td>290000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0035</td><td>本原 正也</td><td>モトハラ マサヤ</td><td>0002</td><td>0</td><td>2005-09-13</td><td>2005-11-26</td><td>280000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0036</td><td>浦多 冬代</td><td>ウラタ フユヨ</td><td>0001</td><td>1</td><td>2005-08-03</td><td>2005-10-17</td><td>260000</td><td>6000</td><td>0004</td><td>2001/01/01</td></tr>
            <tr><td>0037</td><td>鈴丸 輝之</td><td>スズマル テルユキ</td><td>0001</td><td>0</td><td>2005-06-06</td><td>2005-11-15</td><td>240000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0038</td><td>松高 洋一</td><td>マツタカ ヒロカズ</td><td>0003</td><td>0</td><td>2005-08-20</td><td>2005-10-21</td><td>200000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0039</td><td>高松 雅之</td><td>タカマツ マサユキ</td><td>0001</td><td>0</td><td>2005-07-10</td><td>2005-12-12</td><td>170000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0040</td><td>安村 克恵</td><td>ヤスムラ カツエ</td><td>0002</td><td>1</td><td>2005-08-25</td><td>2005-10-15</td><td>210000</td><td></td><td>0001</td><td>2001/01/01</td></tr>
            <tr><td>0041</td><td>丸森 雅美</td><td>マルモリ マサミ</td><td>0001</td><td>1</td><td>2005-06-05</td><td>2005-10-30</td><td>140000</td><td>7000</td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0042</td><td>中原 冬男</td><td>ナカハラ フユオ</td><td>0001</td><td>0</td><td>2005-08-29</td><td>2005-10-21</td><td>170000</td><td></td><td>0005</td><td>2001/01/01</td></tr>
            <tr><td>0043</td><td>原松 春也</td><td>ハラマツ ハルヤ</td><td>0001</td><td>0</td><td>2005-06-22</td><td>2005-12-01</td><td>270000</td><td></td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0044</td><td>村松 冬子</td><td>ムラマツ フユコ</td><td>0001</td><td>1</td><td>2005-08-08</td><td>2005-11-09</td><td>190000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0045</td><td>村松 和子</td><td>ムラマツ カズコ</td><td>0003</td><td>1</td><td>2005-06-11</td><td>2005-12-22</td><td>280000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0046</td><td>尾内 正樹</td><td>オウチ マサキ</td><td>0001</td><td>0</td><td>2005-08-10</td><td>2005-11-21</td><td>150000</td><td>5000</td><td>0002</td><td>2001/01/01</td></tr>
            <tr><td>0047</td><td>多松 正樹</td><td>タマツ マサキ</td><td>0001</td><td>0</td><td>2005-08-07</td><td>2005-10-23</td><td>280000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0048</td><td>浦杉 由美</td><td>ウラスギ ヨシミ</td><td>0002</td><td>1</td><td>2005-08-22</td><td>2005-11-10</td><td>260000</td><td></td><td>0003</td><td>2001/01/01</td></tr>
            <tr><td>0049</td><td>原田 春代</td><td>ハラタ ハルヨ</td><td>0002</td><td>1</td><td>2005-09-12</td><td>2005-10-12</td><td>300000</td><td></td><td>0004</td><td>2001/01/01</td></tr>
            <tr><td>0050</td><td>松丸 正恵</td><td>マツマル マサエ</td><td>0003</td><td>1</td><td>2005-09-04</td><td>2005-11-06</td><td>210000</td><td></td><td>0001</td><td>2001/01/01</td></tr>

        </tbody>
    </table>
    </div>
</div>

</body>
</html>
