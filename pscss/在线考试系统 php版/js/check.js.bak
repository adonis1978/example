// JavaScript Document
////////////////////////////////////////////////////////////////////////////////
　　/*
　　 *--------------- 客户端表单通用验证CheckForm(oForm) -----------------
　　 * 功能:通用验证所有的表单元素.
　　 * 使用:
　　 *　　<form name="form1" onsubmit="return CheckForm(this)">
　　 *　　<input type="text" name="id" check="^\S+$" warning="id不能为空,且不能含有空格">
　　 *　　<input type="submit">
　　 *　　</form>
　　 * author:wanghr100(灰豆宝宝.net)
     * modifile:loach
　　 * email:wanghr100@126.com
　　 * update:19:28 2004-8-23
　　 * 注意:写正则表达式时一定要小心.不要让"有心人"有空子钻.
　　 * 已实现功能:
　　 * 对text,password,hidden,file,textarea,select,radio,checkbox进行合法性验证
　　 * 待实现功能:把正则表式写成个库.
　　 *--------------- 客户端表单通用验证CheckForm(oForm) -----------------
　　 */
　　////////////////////////////////////////////////////////////////////////////////
    
	//正则数组
	/*RegExpArr = Array(
	                          "username"=>"^\S+$" ,//username
						      "password"=>"\S{6,20}",//password6-20位
	                          "email"=>"^[_a-z0-9]+@([_a-z0-9]+\.)+[a-z0-9]{2,3}$",//email
						      "phone"=>"^\d+$",//phone纯数字
						      "file"=>"(.*)(\.jpg|\.bmp)$",//上传文件
						      "date"=>"^\d{4}\-\d{1,2}-\d{1,2}$",//日期格式2005-05-18
						      "textarea"=>"^[\s|\S]{20,}$",//非空大于20个字符
						      "select"=>"^0$",//选择1个 注：'0'为数字0
						      "checkbox"=>"^0{2,}$",//选择2个以上
						      "radio"=>"0$"//选择1个
						      );^*/

　　//主函数
　　function CheckForm(oForm)
　　{
　　　　var els = oForm.elements;
        var password  = els["password"];
		var password2 = els["password2"];
		var email     = els["email"];
		var email2    = els["email2"];
　　　　//遍历所有表元素
　　　　for(var i=0;i<els.length;i++)
　　　　{
　　　　　　//是否需要验证
　　　　　　if(els[i].check)
　　　　　　{
　　　　　　　　//取得验证的正则字符串
　　　　　　　　var sReg = els[i].check;
　　　　　　　　//取得表单的值,用通用取值函数
　　　　　　　　var sVal = GetValue(els[i]);
　　　　　　　　//字符串->正则表达式,不区分大小写
　　　　　　　　var reg = new RegExp(sReg,"i");
　　　　　　　　if(!reg.test(sVal))
　　　　　　　　{
　　　　　　　　　　//验证不通过,弹出提示warning
　　　　　　　　　　alert(els[i].warning);
　　　　　　　　　　//该表单元素取得焦点,用通用返回函数
　　　　　　　　　　GoBack(els[i])  
　　　　　　　　　　return false;
　　　　　　　　}
　　　　　　}
　　　　}
       //程序扩展
        if(password && password2){
		   if(password.value !== password2.value){
		      alert("两次输入密码不一致");
			  GoBack(password2);
			  return false;
		   }
		}
        
        if(email && email2){
		   if(email.value !==email2.value){
		      alert("两次输入邮件地址不一致");
			  GoBack(email2);
			  return false;
		   }
		}
        //alert("通过验证")
		//return false;
　　}

　　//通用取值函数分三类进行取值
　　//文本输入框,直接取值el.value
　　//单多选,遍历所有选项取得被选中的个数返回结果"00"表示选中两个
　　//单多下拉菜单,遍历所有选项取得被选中的个数返回结果"0"表示选中一个
　　function GetValue(el)
　　{
　　　　//取得表单元素的类型
　　　　var sType = el.type;
　　　　switch(sType)
　　　　{
　　　　　　case "text":
　　　　　　case "hidden":
　　　　　　case "password":
　　　　　　case "file":
　　　　　　case "textarea": return el.value;
　　　　　　case "checkbox":
　　　　　　case "radio": return GetValueChoose(el);
　　　　　　case "select-one":
　　　　　　case "select-multiple": return GetValueSel(el);
　　　　}
　　　　//取得radio,checkbox的选中数,用"0"来表示选中的个数,我们写正则的时候就可以通过0{1,}来表示选中个数
　　　　function GetValueChoose(el)
　　　　{
　　　　　　var sValue = "";
　　　　　　//取得第一个元素的name,搜索这个元素组
　　　　
　　var tmpels = document.getElementsByName(el.name);
　　　　　　for(var i=0;i<tmpels.length;i++)
　　　　　　{
　　　　　　　　if(tmpels[i].checked)
　　　　　　　　{
　　　　　　　　　　sValue += "0";
　　　　　　　　}
　　　　　　}
　　　　　　return sValue;
　　　　}
　　　　//取得select的选中数,用"0"来表示选中的个数,我们写正则的时候就可以通过0{1,}来表示选中个数
　　　　function GetValueSel(el)
　　　　{
　　　　　　var sValue = "";
　　　　　　for(var i=0;i<el.options.length;i++)
　　　　　　{
　　　　　　　　//单选下拉框提示选项设置为value=""
　　　　　　　　if(el.options[i].selected && el.options[i].value!="")
　　　　　　　　{
　　　　　　　　　　sValue += "0";
　　　　　　　　}
　　　　　　}
　　　　　　return sValue;
　　　　}
　　}

　　//通用返回函数,验证没通过返回的效果.分三类进行取值
　　//文本输入框,光标定位在文本输入框的末尾
　　//单多选,第一选项取得焦点
　　//单多下拉菜单,取得焦点
　　function GoBack(el)
　　{
　　　　//取得表单元素的类型
　　　　var sType = el.type;
　　　　switch(sType)
　　　　{
　　　　　　case "text":
　　　　　　case "hidden":
　　　　　　case "password":
　　　　　　case "file":
　　　　　　case "textarea": el.focus();var rng = el.createTextRange(); rng.collapse(false); rng.select();
　　　　　　case "checkbox":
　　　　　　case "radio": var els = document.getElementsByName(el.name);els[0].focus();
　　　　　　case "select-one":
　　　　　　case "select-multiple":el.focus();
　　　　}
　　}
    ///补充
	//功能：对单独元素进行匹配检查
	function ckEle(el){
	          
　　　　　　  if(el.check){
　　　　　　　　 //取得验证的正则字符串
　　　　　　　　 var sReg = el.check;
　　　　　　　　 //取得表单的值,用通用取值函数
　　　　　　　　 var sVal = GetValue(el);
　　　　　　　　 //字符串->正则表达式,不区分大小写
　　　　　　　　 var reg = new RegExp(sReg,"i");
　　　　　　　　 if(!reg.test(sVal)){
　　　　　　　　　　//验证不通过,弹出提示warning
　　　　　　　　　　alert(el.warning);
　　　　　　　　　　//该表单元素取得焦点,用通用返回函数
　　　　　　　　　　GoBack(el)  
　　　　　　　　　　return false;
　　　　　　　　 }
　　　　　　  }
		      
	}
   //附录
  
//   \ 做为转意，即通常在"\"后面的字符不按原来意义解释，如/b/匹配字符"b"，当b前面加了反斜杆后/\b/，转意为匹配一个单词的边界。 -或- 对正则表达式功能字符的还原，如"*"匹配它前面元字符0次或多次，/a*/将匹配a,aa,aaa，加了"\"后，/a\*/将只匹配"a*"。 
//   ^  匹配一个输入或一行的开头，/^a/匹配"an A"，而不匹配"An a"  
//   $  匹配一个输入或一行的结尾，/a$/匹配"An a"，而不匹配"an A"  
//   *  匹配前面元字符0次或多次，/ba*/将匹配b,ba,baa,baaa  
//   +  匹配前面元字符1次或多次，/ba*/将匹配ba,baa,baaa  
//   ?  匹配前面元字符0次或1次，/ba*/将匹配b,ba  
//   (x)  匹配x保存x在名为$1...$9的变量中  
//   x|y  匹配x或y  
//   {n}  精确匹配n次  
//   {n,}  匹配n次以上  
//   {n,m}  匹配n-m次  
//   [xyz]  字符集(character set)，匹配这个集合中的任一一个字符(或元字符)  
//   [^xyz]  不匹配这个集合中的任何一个字符  
//   [\b]  匹配一个退格符 
//   \b  匹配一个单词的边界  
//   \B  匹配一个单词的非边界 
//   \cX  这儿，X是一个控制符，/\cM/匹配Ctrl-M  
//   \d  匹配一个字数字符，/\d/ = /[0-9]/  
//   \D  匹配一个非字数字符，/\D/ = /[^0-9]/  
//   \n  匹配一个换行符  
//   \r  匹配一个回车符  
//   \s  匹配一个空白字符，包括\n,\r,\f,\t,\v等  
//   \S  匹配一个非空白字符，等于/[^\n\f\r\t\v]/  
//   \t  匹配一个制表符  
//   \v  匹配一个重直制表符  
//   \w  匹配一个可以组成单词的字符(alphanumeric，这是我的意译，含数字)，包括下划线，如[\w]匹配"$5.98"中的5，等于[a-zA-Z0-9]  
//   \W  匹配一个不可以组成单词的字符，如[\W]匹配"$5.98"中的$，等于[^a-zA-Z0-9]。 

   
  