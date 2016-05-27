//Javascript File 2016/4/9
//调用方法：
/*在文档某处输入$.divslider(container[,main_width][,speed])，其中container参数为必填，表示需要应用滑块的最外层容器。main_width和speed可不填，默认值分别为：容器宽度的2倍和300ms
  然后在divslider-main中加入两个<div class="leftpart">和<div class="rightpart">，用于互相切换。
  最后，需要在左右两个div中加入两个class="divslider-btn-left"和class="divslider-btn-right"按钮，以执行切换动画*/

//应用后结构：
/*
<div class="divslider-container">
    <div class="divslider-main">
        <div class="divslider-main-leftpart"><button class="divslider-btn-left"></button></div>
        <div class="divslider-main-rightpart"><button class="divslider-btn-left"></button</div>
    </div>
</div>
*/


//说明
//需要指定两个按钮，分别命名为:divslider-btn-left和divslider-btn-right
//speed为切换的速度，单位是ms


    
    $(function (){
        jQuery.divSlider = function (container,main_width,speed){
            //进行一些初始设置
            var c_width = $(container).width();//获取容器宽度
            var c_zindex = $(container).css("z-index");//获取容器的z-index
            main_width == undefined?main_width=c_width*2:main_width = main_width;//如果用户自设定main_width则视容器的宽度为设定宽度的一半；否则采用默认值
            $("head").append('<style>.divslider-container{z-index:99;position:relative;overflow:hidden;}.divslider-main{position:absolute;left:0;top:0;height:100%;}'+container+' .leftpart,'+container+' .rightpart{width:'+main_width/2+'px;float:left;margin:0px}</style>');
            $(container).addClass("divslider-container");
            var index = status = 0;//index是当前展示的div的代号，值为0和1；status记录状态
            var default_index = 0;//
            
            
            //下面为容器自动添加div.divslider-main，用户的内容将包裹在main中
            (function (){//判断container里是否有div层
                var ins;
                try{
                    ins = $(container + " div").length;
                    ins>0?status=1:status=0;
                }catch(e){status = 0;}
            })();
            var DivObj = '<div class="divslider-main"></div>';//创建divslider-main，并且对其进行配置
            if(status == 1){
                //status为1时，存在div，则进行包裹
                $(container + " div").wrapAll(DivObj);
            }else{
                //status不为1时，不存在div，则添加
                $(container).append(DivObj);
            }
                //给divslider-main赋予样式
            $(container + " .divslider-main").css({
                "width":main_width+"px",
                "z-index":c_zindex - 1,
            });
                
                
            //下面检测跳转按钮并赋予动画动作
            try{
                var ins = $("body a.divslider-btn-left,button.divslider-btn-left,input[type='button'].divslider-btn-left").length + $("body a.divslider-btn-right,button.divslider-btn-right,input[type='button'].divslider-btn-right").length;
                if(ins > 0)status = 1;else status = 0;
            }catch(e){status = 0}
            if(status == 1){//设置了按钮
                $(".divslider-btn-left").on("click",function (){dragin("weinleft",speed);return false;});
                $(".divslider-btn-right").on("click",function (){dragin("weinright",speed);return false;});
            }else{return ;}
            
            
            //下面下面定义了几个函数            
            function dragin(screen_position,speed){
                if(speed == undefined){speed= 300;}
                //screen_position只接受两个值:weinleft和weinright，分别表示"当前显示的是左侧"和"当前显示的是右侧""
                if(screen_position == "weinleft"){//现在显示左侧，需要从右边拉东西
                    $(".divslider-main").stop(true,false).animate({
                        "left":-main_width/2,
                    },speed);
                }else if(screen_position == "weinright"){//现在显示右侧，需要从左边拉东西
                    $(".divslider-main").stop(true,false).animate({
                        "left":0,
                    },speed);
                }
            }
            
            
            
        }//jQuery.divslider  
    });//$()