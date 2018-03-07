<br /><br /><br /><br />
<font color="red" size=6>1、点击下面的按钮获取自己的私人钱包地址，挖矿或者从交易所提现就不用下载全节点钱包了，以后要卖币再下载全节点钱包导入私钥就可以了！！！</font><br />
<font color="red" size=6>2、复制下面红色字体内的地址、私钥信息到你本地文档！！！！</font><br />
<font color="red" size=6>3、以下私钥信息只会在网站出现一次，网站没有做任何保存或者记录！！！请在本地保存好再使用！！！</font><br />
<font color="red" size=6>4、丢失下面的私钥信息，币也会丢失，跟你钱包的wallet.dat丢失一样，找不回来了，请一定保管好，丢失责任自负！！！与本人无关！！！</font><br />
<font color="red" size=6>5、本网站只提供给本人和本人的矿工朋友用，其他人可以使用，但是不要联系我，人太多了，没法提供服务！！！</font><br />
<font color="red" size=6>6、本网站代码开源地址 https://github.com/rat16/btc_wallet</font><br />
<font color="blue" size=4>比特币分叉币币种:</font><br /><br />
<select id="btc_type">
	<option value="rvn">RVN</option>
	<option value="cdy">CDY</option>
	<option value="bcx">BCX</option>
	<option value="bcd">BCD</option>
	<option value="btg">BTG</option>
	<option value="sbtc">SBTC</option>
	<option value="btc">BTC</option>
</select><br /><br />
<button type="submit" id="btn_click">获取新地址和私钥</button><br /><br />

=======================================================<br /><br />
<font color="red" size=6>您的<span id="btc_title"></span>地址为：</font><br />
<font color="red" size=6>地址:</font>
<div id="btc_addr"></div><br /><br />
<font color="red" size=6>私钥:</font>
<div id="btc_priv_key"></div><br /><br />
=======================================================<br /><br />
<br /><br />
捐赠地址：<br /><br />
BTC:<br />
12obq2WbXKQ9fCn2VTZPCJsxekgWXK8mQQ<br /><br />
BCX:<br />
XTUcPN69vFMBhJ3axRyo3fjd2UuhfpjK2K<br /><br />
BTV：<br />
149Go6vq5b2ztgR46kqwfn9eKpSodK9ULq<br /><br />
BPA:<br />
PPV8mkt2UXTCMx8ooLpenE1wKfcMpMohTY<br /><br />
CDY:<br />
CWDVRr2BCD1ZsKzADrxr9jj8ZcunbFHhVJ<br /><br />

区块浏览器地址：<br /><br />
BTC:<a href="https://blockchain.info">https://blockchain.info</a>
<br /><br />

BCX:<a href="https://bcx.info">https://bcx.info</a>
<br /><br />

BTV:
<br /><br />
BTN:<a href="http://39.104.79.7">http://39.104.79.7/</a>
<br /><br />

BPA:<a href="http://47.100.55.227">http://47.100.55.227</a>
<br /><br />
<br /><br />

<script type="text/javascript" src="/jquery-1.12.4.js"></script>
<script type="text/javascript">
window.btc_id = "";

$(document).ready(function(){
    $('#btn_click').click(function(){
    	$("#btn_click").attr("disabled",true);
    	$.post(
			"/wallet/getnewaddress",
			{
				btc_type: $("#btc_type").val(),
			},
			function(data)
			{
				console.log("btc_id = " + data.btc_id);
				window.btc_id = data.btc_id;
			},
			'json'
		);


        var id = setInterval(function(){
    		$.post(
    			"/wallet/getaddrstatus",
    			{
    				btc_id: window.btc_id,
    			},
    			function(data2)
    			{
        			console.log(data2.code);
    				if(data2.code == 0)
    				{
    					btc_addr = data2.btc_addr;
    					btc_priv_key = data2.btc_priv_key;
    					btc_type = data2.btc_type;
    					$("#btc_addr").text(btc_addr);
    					$("#btc_priv_key").text(btc_priv_key);
    					$("#btc_title").text(btc_type);
    					clearInterval(id);

    			    	$("#btn_click").attr("disabled", false);
    				}
    			},
    			'json'
    		);
    	}, 2000);
    });

});
</script>


