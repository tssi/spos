var ssUtil = function() {
	return {
		tree:function (data) {    
			if (typeof(data) == 'object') {        
				var ul = $('<ul>');
				for (var i in data) {            
					ul.append($('<li>').text(i).append(tree(data[i])));         
				}        
				return ul;
			} else {       
				var textNode = document.createTextNode(' => ' + data);
				return textNode;
			}
		},
		
		cch_brk:function (url){
			return url+'?rnd='+Math.floor(Math.random()*999);
		},
		
		roundNumber:function (number,decimal_points) {
			if(!decimal_points) return Math.round(number);
			if(number == 0) {
				var decimals = "";
				for(var i=0;i<decimal_points;i++) decimals += "0";
				return "0."+decimals;
			}

			var exponent = Math.pow(10,decimal_points);
			var num = Math.round((number * exponent)).toString();
			return num.slice(0,-1*decimal_points) + "." + num.slice(-1*decimal_points);
		},
		
		parseDate:function (str) {
			var mdy = str.split('-');
			return new Date(mdy[0], mdy[1]-1, mdy[2]);
		},
		
		daydiff:function (first, second) {
			return (second-first)/(1000*60*60*24)
		},
		
		upperFirst:function(s){
			var str =  s+'';
			return str.chartAt(0).toUpperCase + str.slice(1);
		}, 
		sortObject:function(o) {
			var sorted = {},
			key, a = [];

			for (key in o) {
				if (o.hasOwnProperty(key)) {
						a.push(key);
				}
			}

			a.sort();

			for (key = 0; key < a.length; key++) {
				sorted[a[key]] = o[a[key]];
			}
			return sorted;
		},
		formatCurrency:function(num) {
			num = num.toString().replace(/\$|\,/g,'');
			if(isNaN(num))
				num = "0";
				sign = (num == (num = Math.abs(num)));
				num = Math.floor(num*100+0.50000000001);
				cents = num%100;
				num = Math.floor(num/100).toString();
			if(cents<10)
				cents = "0" + cents;
				for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
				num = num.substring(0,num.length-(4*i+3))+','+
				num.substring(num.length-(4*i+3));
			return (((sign)?'':'-') + num + '.' + cents);
		},
		toProperCase:function(txt){
			var proper = '';
			txt = txt.toString();
			var temp = txt.split(' ');
			$.each(temp,function(ctr, o){
				proper+=o.charAt(0).toUpperCase()+o.substring(1).toLowerCase()+' ';
			
			})
			//console.log(proper);
			return $.trim(proper);
		}
	}
}();








