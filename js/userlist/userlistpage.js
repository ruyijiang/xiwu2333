/***初始化设置echart**/
	 var myChart_most = echarts.init(document.getElementById('user-most'));
	 option1 = {
		tooltip : {
			trigger: 'axis',
			axisPointer : {            // 坐标轴指示器，坐标轴触发有效
				type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
			}
		},
		grid: {
			left: '1%',
			right: '1%',
			bottom: '5%',
			top:"15%",
			containLabel: true
		},
		xAxis : [
			{
				type : 'category',
				data : ['广东','浙江','上海']
			}
		],
		yAxis : [
			{
				type : 'value'
			}
		],
		series : [
			{
				type:'bar',
				data:[375, 332, 301]
			},
		]
	};
	
	 var myChart_ratio = echarts.init(document.getElementById('user-ratio'));
	 option2 = {
		series : [
			{
				type: 'pie',
				radius : '55%',
				data:[
					{value:12, name:'女'},
					{value:88, name:'男'}
				],
			}
		],
	};
	
	 var myChart_online = echarts.init(document.getElementById('user-online'));
	 option3 = {
		tooltip: {
			trigger: 'axis'
		},
		grid: {
			left: '1%',
			right: '10%',
			bottom: '5%',
			top: '15%',
			containLabel: true
		},
		toolbox: {
			feature: {
				saveAsImage: {}
			}
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: ['14:00','15:00','16:00','17:00','17:51']
		},
		yAxis: {
			type: 'value'
		},
		series: [
			{
				name:'今天',
				type:'line',
				stack: '总量',
				data:[75,120, 132, 101, 134]
			}
		]
	};
	
	
	//实例echart
	myChart_most.setOption(option1);
	myChart_ratio.setOption(option2);
	myChart_online.setOption(option3);
