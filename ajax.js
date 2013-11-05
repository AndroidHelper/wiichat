var http_request=false;
var ht;
	function createXMLHttpRequest(){
		http_request=false;
		//初始化XMLHttpRequest对象
		if(window.XMLHttpRequest){//Mozilla浏览器
			http_request=new XMLHttpRequest();
			if(http_request.overrideMimeType){//设置Mime类别
				http_request.overrideMimeType("text/xml");
			}
		}
		else if (window.ActiveXObject)
		{//IE browser
			try
			{
				http_request=new ActiveXObject("MSXML2.XMLHTTP");
			}
			catch (e)
			{
				try
				{
					http_request=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
					try
					{
						http_request=new ActiveXObject("MSXML3.XMLHTTP");
					}
					catch (e)
					{
						return http_request;
					}
				}
			}
		}
		if (!http_request)
		{//异常，创建对象失败
			window.alert("不能创建XMLHttpRequest对象实例");
			return false;
		}
	}
      // 处理增加品牌响应函数
     function AddStateChange() {
        if (http_request.readyState == 4) { // 判断对象状态
            //alert(XMLHttpReq.status);
            if (http_request.status == 200) { // 信息已经成功返回，开始处理信息
				ht=http_request.responseText;
				//alert(document.getElementById("contentlist").innerHTML);
                    //getContents();//如果添加成功就到这一步
				document.getElementById("contentlist").innerHTML=ht;
					
               }else { //页面不正常
                    window.alert("您所请求的页面有异常。");
               }
            }
     }
     //响应用户点击新增操作
     function getContent() {   
		 var filename=document.getElementById('file').value;
		 var url=document.getElementById('url').value;
          //其实通过XML发到服务器端的JAVA文件中去了
		  var r= parseInt(Math.random()*500+1);
          var url = "getContents.php?filename="+ filename+"&url="+url+"&r="+r;//表示是添加操作并且将名字传入
          createXMLHttpRequest();
          http_request.onreadystatechange = AddStateChange;//监听状态是否变化
          http_request.open("GET", url, true);//java文件中可以处理doGet方法
          http_request.send(null);
     }  
   