function reverseArr(input) {
    var ret = new Array;
    for(var i = input.length-1; i >= 0; i--) {
        ret.push(input[i]);
    }
    return ret;
}
function concatenate(input1,input2,input3,input4)
{
	var ret=new Array;
	var i;
	for(i=0;i<input1.length;i++)
		ret.push(input1[i]);
	for(i=0;i<input2.length;i++)
		ret.push(input2[i]);
	for(i=0;i<input3.length;i++)
		ret.push(input3[i]);
	for(i=0;i<input4.length;i++)
		ret.push(input4[i]);
	return ret;
}
var color;
var b=document.getElementsByClassName("number")[0];
var a=document.getElementsByClassName("roll")[0];
var d=document.getElementById("turn");
var lockerA=document.getElementsByClassName("lockerA")[0].getElementsByTagName("h1")[0];
var lockerB=document.getElementsByClassName("lockerB")[0].getElementsByTagName("h1")[0];
var i=document.getElementsByClassName("f1")[0].getElementsByTagName("div");
var f=document.getElementsByClassName("f3")[0].getElementsByTagName("div");
var g=document.getElementsByClassName("f4")[0].getElementsByTagName("div");
g=reverseArr(g);
var h=document.getElementsByClassName("f2")[0].getElementsByTagName("div");
h=reverseArr(h);
var e=concatenate(i,f,g,h);
var k=concatenate(g,h,i,f);
var c;
var l=true,m=true;
var button=document.getElementsByTagName("button")[0];
button.addEventListener("click",validateForm);
function blinktext(win)
{
	var winner=document.getElementById(win+"won");
	setInterval(function()
	{
		winner.style.visibility=winner.style.visibility=="hidden"?"visible":"hidden";
	},500);
}
function validateForm()
{
	c=document.getElementById("number").value;
	c=parseInt(c);
	b.innerHTML=c;
	take_steps(c);
}
a.addEventListener("click",randomNum);
	function randomNum()
	{
		chance=false;
		c=parseInt(Math.random()*6+1);
		b.innerHTML=c;
		take_steps(c);
	}
function myFunction(input1,str1,input2,str2)
{
	input1.innerHTML=str1;
	input2.innerHTML=str2;
}
function take_steps(c)
{
	var i,g,ind,s;
	if(d.innerHTML=="TURN:Player A")
	{
		if(l)
		{
			if(c==6)
			{
				if(lockerA.innerHTML=="OO")
				{
					lockerA.innerHTML="O";
					s=document.getElementsByClassName("b1")[0].innerHTML;
					color=document.getElementsByClassName("b1")[0].style.color;
					if(s=="O" && color=="blue")
					{
						if(lockerB.innerHTML=="O")
							lockerB.innerHTML="OO";
						else
							lockerB.innerHTML="O";
					}
					if(s=="OO" && color=="blue")
						lockerB.innerHTML="OO";
					document.getElementsByClassName("b1")[0].innerHTML="O";
					document.getElementsByClassName("b1")[0].style.color="red";
					setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				}
				else if(lockerA.innerHTML=="O")
				{
					var g,ind;
					e.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="red")
						{
							g=item;
							ind=index;
						}
					}
							if((ind+6)>28)
							{
								lockerA.innerHTML="";
								s=document.getElementsByClassName("b1")[0].innerHTML;
								color=document.getElementsByClassName("b1")[0].style.color;
								if(s=="O" && color=="blue")
								{
									if(lockerB.innerHTML=="O")
										lockerB.innerHTML="OO";
									else
										lockerB.innerHTML="O";
								}
								if(s=="OO" && color=="blue")
									lockerB.innerHTML="OO";
								document.getElementsByClassName("b1")[0].innerHTML="O";
								document.getElementsByClassName("b1")[0].style.color="red";
								d.innerHTML="TURN:Player A";
								b.innerHTML="";
								$(lockerA).unbind("click");
							}
							else
								g.addEventListener("click",handler1);
					$(lockerA).unbind('click').bind('click',handler2);
					function handler1()
					{
						try
						{
							g.innerHTML="";
							s=e[ind+6].innerHTML;
							color=e[ind+6].style.color;
							if(s=="O" && color=="blue")
							{
								if(lockerB.innerHTML=="O")
									lockerB.innerHTML="OO";
								else
									lockerB.innerHTML="O";
							}
							if(s=="OO" && color=="blue")
								lockerB.innerHTML="OO";
							e[ind+6].innerHTML="O";
							e[ind+6].style.color="red";
							$(lockerA).unbind("click");
							g.removeEventListener("click",handler1);
							d.innerHTML="TURN:Player A";
							b.innerHTML="";
						}
						catch(err)
						{
							l=false;
							g.innerHTML="";
							d.innerHTML="TURN:Player A";
							b.innerHTML="";
							$(lockerA).unbind("click");
							g.removeEventListener("click",handler1);
						}
					}
					function handler2()
					{
						lockerA.innerHTML="";
						s=document.getElementsByClassName("b1")[0].innerHTML;
						color=document.getElementsByClassName("b1")[0].style.color;
						if(s=="O" && color=="blue")
						{
							if(lockerB.innerHTML=="O")
								lockerB.innerHTML="OO";
							else
								lockerB.innerHTML="O";
						}
						if(s=="OO" && color=="blue")
							lockerB.innerHTML="OO";
						if(document.getElementsByClassName("b1")[0].innerHTML=="O" && color=="red")
						{
							document.getElementsByClassName("b1")[0].innerHTML="OO";
							document.getElementsByClassName("b1")[0].style.color="red";
						}
						else
						{
							document.getElementsByClassName("b1")[0].innerHTML="O";
							document.getElementsByClassName("b1")[0].style.color="red";
						}
						d.innerHTML="TURN:Player A";
						b.innerHTML="";
						g.removeEventListener("click",handler1);
					}
				}
				else
				{
					var p=0,x=-1,y=-1,z=-1;
					e.forEach(changeValue)
					function changeValue(item,index)
					{
						
						if(item.innerHTML=="O" && item.style.color=="red")
						{
							if(x==-1)
								x=index;
							else
								y=index;
						}
						if(item.innerHTML=="OO" && item.style.color=="red")
						{
							z=index;
						}
					}
					if(x+6<=28 && x!=-1)
					{
						e[x].addEventListener("click",func1);
						p++;
					}
					if(y+6<=28 && y!=-1)
					{
						e[y].addEventListener("click",func2);
						p++;
					}
					if(p==0)
					{
						setTimeout(myFunction,500,b,"",d,"TURN:Player A");
					}
					if(z!=-1)
					{
						if(z+6<28)
						{
							e[z].innerHTML="O";
							e[z].style.color="red";
							s=e[z+6].innerHTML;
							color=e[z+6].style.color;
							if(s=="O" && color=="blue")
							{
								if(lockerB.innerHTML=="O")
									lockerB.innerHTML="OO";
								else
									lockerB.innerHTML="O";  
							}
							if(s=="OO" && color=="blue")
								lockerB.innerHTML="OO";
							e[z+6].innerHTML="O";
							e[z+6].style.color="red";
							setTimeout(myFunction,500,b,"",d,"TURN:Player A");
						}
						else if(z==28)
						{
							e[z].innerHTML="O";
							e[z].style.color="red";
							l=false;
							setTimeout(myFunction,500,b,"",d,"TURN:Player A");
						}
						else
							setTimeout(setTimeout,500,b,"",d,"TURN:Player A");
					}
					function func1()
					{
							if(x+6<28)
							{
									e[x].innerHTML="";
									s=e[x+6].innerHTML;
									color=e[x+6].style.color;
									if(s=="O" && color=="blue")
									{
										if(lockerB.innerHTML=="O")
											lockerB.innerHTML="OO";
										else
											lockerB.innerHTML="O";
									}
									if(s=="OO" && color=="blue")
										lockerB.innerHTML="OO";
									e[x+6].innerHTML=e[x+6].innerHTML=="O" && e[x+6].style.color=="red"?"OO":"O";
									e[x+6].style.color="red";
									d.innerHTML="TURN:Player A";
									b.innerHTML="";
							}
							else
							{
								e[x].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player A";
								l=false;
							}
							e[x].removeEventListener("click",func1);
							e[y].removeEventListener("click",func2);
					}
					function func2()
					{
							if(y+6<28)
							{
									e[y].innerHTML="";
									s=e[y+6].innerHTML;
									color=e[y+6].style.color;
									if(s=="O" && color=="blue")
									{
										if(lockerB.innerHTML=="O")
											lockerB.innerHTML="OO";
										else
											lockerB.innerHTML="O";
									}
									if(s=="OO" && color=="blue")
										lockerB.innerHTML="OO";
									e[y+6].innerHTML=e[y+6].innerHTML=="O" && e[y+6].style.color=="red"?"OO":"O";
									e[y+6].style.color="red";
									d.innerHTML="TURN:Player A";
									b.innerHTML="";
							}
							else
							{
								e[y].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player A";
								l=false;
							}
							e[x].removeEventListener("click",func1);
							e[y].removeEventListener("click",func2);
					}
				}
			}
			else
			{
				if(lockerA.innerHTML=="O")
				{
					var ind;
					e.forEach(changeValue)
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="red")
							ind=index;
					}
							if(ind+c<28)
							{
								e[ind].innerHTML="";
								s=e[ind+c].innerHTML;
								color=e[ind+c].style.color;
								if(s=="O" && color=="blue")
								{
									if(lockerB.innerHTML=="O")
										lockerB.innerHTML="OO";
									else
										lockerB.innerHTML="O";
								}
								if(s=="OO" && color=="blue")
									lockerB.innerHTML="OO";
								e[ind+c].innerHTML=e[ind+c].innerHTML=="O" && e[ind+c].style.color=="red"?"OO":"O";
								e[ind+c].style.color="red";
								setTimeout(myFunction,500,b,"",d,"TURN:Player B");
							}
								else if(ind+c==28)
								{
									e[ind].innerHTML="";
									l=false;
									setTimeout(myFunction,500,b,"",d,"TURN:Player B");
								}
								else
									setTimeout(myFunction,500,b,"",d,"TURN:Player B");

				}
				else if(lockerA.innerHTML=="OO")
				{
					setTimeout(myFunction,500,b,"",d,"TURN:Player B");
				}
				else
				{
					var p=0,x=-1,y=-1,z=-1;
					e.forEach(changeValue)
					function changeValue(item,index)
					{
						
						if(item.innerHTML=="O" && item.style.color=="red")
						{
							if(x==-1)
								x=index;
							else
								y=index;
						}
						if(item.innerHTML=="OO" && item.style.color=="red")
						{
							z=index;
						}
					}
					if(x+c<=28 && x!=-1)
					{
						e[x].addEventListener("click",func1);
						p++;
					}
					if(y+c<=28 && y!=-1)
					{
						e[y].addEventListener("click",func2);
						p++;
					}
					if(p==0)
					{
						setTimeout(myFunction,500,b,"",d,"TURN:Player B");
					}
					if(z!=-1)
					{
						if(z+c<28)
						{
							e[z].innerHTML="O";
							e[z].style.color="red";
							s=e[z+c].innerHTML;
							color=e[z+c].style.color;
							if(s=="O" && color=="blue")
							{
								if(lockerB.innerHTML=="O")
									lockerB.innerHTML="OO";
								else
									lockerB.innerHTML="O";  
							}
							if(s=="OO" && color=="blue")
								lockerB.innerHTML="OO";
							e[z+c].innerHTML="O";
							e[z+c].style.color="red";
							setTimeout(myFunction,500,b,"",d,"TURN:Player B");
						}
						else if(z+c==28)
						{
							e[z].innerHTML="O";
							e[z].style.color="red";
							l=false;
							setTimeout(myFunction,500,b,"",d,"TURN:Player B");
						}
						else
							setTimeout(myFunction,500,b,"",d,"TURN:Player B");
					}
					function func1()
					{
							if(x+c<28)
							{
									e[x].innerHTML="";
									s=e[x+c].innerHTML;
									color=e[x+c].style.color;
									if(s=="O" && color=="blue")
									{
										if(lockerB.innerHTML=="O")
											lockerB.innerHTML="OO";
										else
											lockerB.innerHTML="O";
									}
									if(s=="OO" && color=="blue")
										lockerB.innerHTML="OO";
									e[x+c].innerHTML=e[x+c].innerHTML=="O" && e[x+c].style.color=="red"?"OO":"O";
									e[x+c].style.color="red";
									d.innerHTML="TURN:Player B";
									b.innerHTML="";
							}
							else
							{
								e[x].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player B";
								l=false;
							}
							e[x].removeEventListener("click",func1);
							e[y].removeEventListener("click",func2);
					}
					function func2()
					{
							if(y+c<28)
							{
									e[y].innerHTML="";
									s=e[y+c].innerHTML;
									color=e[y+c].style.color;
									if(s=="O" && color=="blue")
									{
										if(lockerB.innerHTML=="O")
											lockerB.innerHTML="OO";
										else
											lockerB.innerHTML="O";
									}
									if(s=="OO" && color=="blue")
										lockerB.innerHTML="OO";
									e[y+c].innerHTML=e[y+c].innerHTML=="O" && e[y+c].style.color=="red"?"OO":"O";
									e[y+c].style.color="red";
									d.innerHTML="TURN:Player B";
									b.innerHTML="";
							}
							else
							{
								e[y].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player B";
								l=false;
							}
							e[x].removeEventListener("click",func1);
							e[y].removeEventListener("click",func2);
					}
				}	
			}
		}
		else
		{
			if(c==6)
			{
				if(lockerA.innerHTML=="O")
				{
					lockerA.innerHTML="";
					s=document.getElementsByClassName("b1")[0].innerHTML;
					color=document.getElementsByClassName("b1")[0].style.color;
					if(s=="O" && color=="blue")
					{
						if(lockerB.innerHTML="O")
							lockerB.innerHTML="OO";
						else
							lockerB.innerHTML="O";
					}
					if(s=="OO" && color=="blue")
						lockerB.innerHTML="OO";
					document.getElementsByClassName("b1")[0].innerHTML="O";
					document.getElementsByClassName("b1")[0].style.color="red";
					setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				}	
				else
				{
					var ind;
					e.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="red")
							ind=index;
					}
							if((ind+6)==28)
							{
								e[ind].innerHTML="";
								blinktext("a");
								a.removeEventListener("click",randomNum);
								button.removeEventListener("click",validateForm);
							}
							else if((ind+6)<28)
							{
								e[ind].innerHTML="";
								s=e[ind+6].innerHTML;
								color=e[ind+6].style.color;
								if(s=="O" && color=="blue")
								{
									if(lockerB.innerHTML=="O")
										lockerB.innerHTML="OO";
									else
										lockerB.innerHTML="O";
								}
								if(s=="OO" && color=="blue")
									lockerB.innerHTML="OO";
								e[ind+6].innerHTML="O";
								e[ind+6].style.color="red";
								setTimeout(myFunction,500,b,"",d,"TURN:Player A");
							}
							else
								setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				}			
			}
			else
			{
				if(lockerA.innerHTML=="O")
					setTimeout(myFunction,500,b,"",d,"TURN:Player B");
				else
				{
					var ind;
					e.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="red")
							ind=index;
					}
							if(ind+c==28)
							{
								e[ind].innerHTML="";
								blinktext("a");
								a.removeEventListener("click",randomNum);
								button.removeEventListener("click",validateForm);
							}
							else if(ind+c<28)
							{
								e[ind].innerHTML="";
								s=e[ind+c].innerHTML;
								color=e[ind+c].style.color;
								if(s=="O" && color=="blue")
								{
									if(lockerB.innerHTML=="O")
										lockerB.innerHTML="OO";
									else
										lockerB.innerHTML="O";
								}
								if(s=="OO" && color=="blue")
									lockerB.innerHTML="OO";
								e[ind+c].innerHTML="O";
								e[ind+c].style.color="red";
								setTimeout(myFunction,500,b,"",d,"TURN:Player B");
							}
							else
								setTimeout(myFunction,500,b,"",d,"TURN:Player B");
				}
			}
		}
	}
	else
	{
		if(m)
		{
			if(c==6)
			{
				if(lockerB.innerHTML=="OO")
				{
					lockerB.innerHTML="O";
					s=document.getElementsByClassName("b15")[0].innerHTML;
					color=document.getElementsByClassName("b15")[0].style.color;
					if(s=="O" && color=="red")
					{
						if(lockerA.innerHTML=="O")
							lockerA.innerHTML="OO";
						else
							lockerA.innerHTML="O";
					}
					if(s=="OO" && color=="red")
						lockerA.innerHTML="OO";
					document.getElementsByClassName("b15")[0].innerHTML="O";
					document.getElementsByClassName("b15")[0].style.color="blue";
					setTimeout(myFunction,500,b,"",d,"TURN:Player B");
				}
				else if(lockerB.innerHTML=="O")
				{
					var g,ind;
					k.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="blue")
						{
							g=item;
							ind=index;
						}
					}
							if((ind+6)>28)
							{
								lockerB.innerHTML="";
								s=document.getElementsByClassName("b15")[0].innerHTML;
								color=document.getElementsByClassName("b15")[0].style.color;
								if(s=="O" && color=="red")
								{
									if(lockerA.innerHTML=="O")
										lockerA.innerHTML="OO";
									else
										lockerA.innerHTML="O";
								}
								if(s=="OO" && color=="red")
									lockerA.innerHTML="OO";
								document.getElementsByClassName("b15")[0].innerHTML="O";
								document.getElementsByClassName("b15")[0].style.olor="blue";
								d.innerHTML="TURN:Player B";
								b.innerHTML="";
								$(lockerB).unbind("click");
							}
							else
								g.addEventListener("click",handler1);
					$(lockerB).unbind('click').bind("click",handler2);
					function handler1()
					{
						try
						{	
							g.innerHTML="";
							s=k[ind+6].innerHTML;
							color=k[ind+6].style.color;
							if(s=="O" && color=="red")
							{
								if(lockerA.innerHTML=="O")
									lockerA.innerHTML="OO";
								else
									lockerA.innerHTML="O";
							}
							if(s=="OO" && color=="red")
								lockerA.innerHTML="OO";
							k[ind+6].innerHTML="O";
							k[ind+6].style.color="blue";
							d.innerHTML="TURN:Player B";
							b.innerHTML="";
							$(lockerB).unbind("click");
							g.removeEventListener("click",handler1);
						}
						catch(err)
						{
							g.innerHTML="";
							d.innerHTML="TURN:Player A";
							b.innerHTML="";
							m=false;
							$(lockerA).unbind("click");
							g.removeEventListener("click",handler1);
						}
					}
					function handler2()
					{
						lockerB.innerHTML="";
						s=document.getElementsByClassName("b15")[0].innerHTML;
						color=document.getElementsByClassName("b15")[0].style.color;
						if(s=="O" && color=="red")
						{
							if(lockerA.innerHTML=="O")
								lockerA.innerHTML="OO";
							else
								lockerA.innerHTML="O";
						}
						if(s=="OO" && color=="red")
							lockerA.innerHTML="OO";
						if(document.getElementsByClassName("b15")[0].innerHTML=="O" && color=="blue")
						{
							document.getElementsByClassName("b15")[0].innerHTML="OO";
							document.getElementsByClassName("b15")[0].style.color="blue";
						}
						else
						{
							document.getElementsByClassName("b15")[0].innerHTML="O";
							document.getElementsByClassName("b15")[0].style.color="blue";
						}
						d.innerHTML="TURN:Player B";
						b.innerHTML="";
						g.removeEventListener("click",handler1);
					}
				}
				else
				{
					var p=0,x=-1,y=-1,z=-1;
					k.forEach(changeValue)
					function changeValue(item,index)
					{
						
						if(item.innerHTML=="O" && item.style.color=="blue")
						{
							if(x==-1)
								x=index;
							else
								y=index;
						}
						if(item.innerHTML=="OO" && item.style.color=="blue")
						{
							z=index;
						}
					}
					if(x+6<=28 && x!=-1)
					{
						k[x].addEventListener("click",func1);
						p++;
					}
					if(y+6<=28 && y!=-1)
					{
						k[y].addEventListener("click",func2);
						p++;
					}
					if(p==0)
					{
						setTimeout(myFunction,500,b,"",d,"TURN:Player B");
					}
					if(z!=-1)
					{
						if(z+6<28)
						{
							k[z].innerHTML="O";
							k[z].style.color="blue";
							s=k[z+6].innerHTML;
							color=k[z+6].style.color;
							if(s=="O" && color=="red")
							{
								if(lockerA.innerHTML=="O")
									lockerA.innerHTML="OO";
								else
									lockerA.innerHTML="O";  
							}
							if(s=="OO" && color=="red")
								lockerA.innerHTML="OO";
							k[z+6].innerHTML="O";
							k[z+6].style.color="blue";
							setTimeout(myFunction,500,b,"",d,"TURN:Player B");
						}
						else if(z==28)
						{
							k[z].innerHTML="O";
							k[z].style.color="blue;"
							m=false;
							setTimeout(myFunction,500,b,"",d,"TURN:Player B");
						}
						else
							setTimeout(setTimeout,500,b,"",d,"TURN:Player B");
					}
					function func1()
					{
							if(x+6<28)
							{
									k[x].innerHTML="";
									s=k[x+6].innerHTML;
									color=k[x+6].style.color;
									if(s=="O" && color=="red")
									{
										if(lockerA.innerHTML=="O")
											lockerA.innerHTML="OO";
										else
											lockerA.innerHTML="O";
									}
									if(s=="OO" && color=="red")
										lockerA.innerHTML="OO";
									k[x+6].innerHTML=k[x+6].innerHTML=="O" && k[x+6].style.color=="blue"?"OO":"O";
									k[x+6].style.color="blue";
									d.innerHTML="TURN:Player B";
									b.innerHTML="";
							}
							else
							{
								k[x].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player B";
								m=false;
							}
							k[x].removeEventListener("click",func1);
							k[y].removeEventListener("click",func2);
					}
					function func2()
					{
							if(y+6<28)
							{
									k[y].innerHTML="";
									s=k[y+6].innerHTML;
									color=k[y+6].style.color;
									if(s=="O" && color=="red")
									{
										if(lockerA.innerHTML=="O")
											lockerA.innerHTML="OO";
										else
											lockerA.innerHTML="O";
									}
									if(s=="OO" && color=="red")
										lockerA.innerHTML="OO";
									k[y+6].innerHTML=k[y+6].innerHTML=="O" && k[y+6].style.color=="blue"?"OO":"O";
									k[y+6].style.color="blue";
									d.innerHTML="TURN:Player B";
									b.innerHTML="";
							}
							else
							{
								k[y].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player B";
								m=false;
							}
							k[x].removeEventListener("click",func1);
							k[y].removeEventListener("click",func2);
					}
				}
			}
			else
			{
			if(lockerB.innerHTML=="O")
				{
					var ind;
					k.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="blue")
							ind=index;
					}
							if(ind+c<28)
							{
								k[ind].innerHTML="";
								s=k[ind+c].innerHTML;
								color=k[ind+c].style.color;
								if(s=="O" && color=="red")
								{
									if(lockerA.innerHTML=="O")
										lockerA.innerHTML="OO";
									else
									{
										lockerA.innerHTML="O";
									}
								}
								if(s=="OO" && color=="red")
									lockerA.innerHTML="OO";
								k[ind+c].innerHTML=k[ind+c].innerHTML=="O" && k[ind+c].style.color=="blue"?"OO":"O";
								k[ind+c].style.color="blue";
								setTimeout(myFunction,500,b,"",d,"TURN:Player A");
							}
								else if(ind+c==28)
								{
									k[ind].innerHTML="";
									m=false;
									setTimeout(myFunction,500,b,"",d,"TURN:Player A");
								}
								else
									setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				}
				else if(lockerB.innerHTML=="OO")
				{
					setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				}
				else
				{
					var p=0,x=-1,y=-1,z=-1;
					k.forEach(changeValue)
					function changeValue(item,index)
					{
						
						if(item.innerHTML=="O")
						{
							if(x==-1)
								x=index;
							else
								y=index;
						}
						if(item.innerHTML=="OO")
						{
							z=index;
						}
					}
					if(x+c<=28 && x!=-1)
					{
						k[x].addEventListener("click",func1);
						p++;
					}
					if(y+c<=28 && y!=-1)
					{
						k[y].addEventListener("click",func2);
						p++;
					}
					if(p==0)
					{
						setTimeout(myFunction,500,b,"",d,"TURN:Player A");
					}
					if(z!=-1)
					{
						if(z+c<28)
						{
							k[z].innerHTML="O";
							k[z].style.color="blue";
							s=k[z+c].innerHTML;
							color=k[z+c].style.color;
							if(s=="O" && color=="red")
							{
								if(lockerA.innerHTML=="O")
									lockerA.innerHTML="OO";
								else
									lockerA.innerHTML="O";  
							}
							if(s=="OO" && color=="red")
								lockerA.innerHTML="OO";
							k[z+c].innerHTML="O";
							k[z+c].style.color="blue";
							setTimeout(myFunction,500,b,"",d,"TURN:Player A");
						}
						else if(z+c==28)
						{
							k[z].innerHTML="O";
							k[z].style.color="blue";
							m=false;
							setTimeout(myFunction,500,b,"",d,"TURN:Player A");
						}
						else
							setTimeout(myFunction,500,b,"",d,"TURN:Player A");
					}
					function func1()
					{
							if(x+c<28)
							{
									k[x].innerHTML="";
									s=k[x+c].innerHTML;
									color=k[x+c].style.color;
									if(s=="O" && color=="red")
									{
										if(lockerA.innerHTML=="O")
											lockerA.innerHTML="OO";
										else
											lockerA.innerHTML="O";
									}
									if(s=="OO" && color=="red")
										lockerA.innerHTML="OO";
									k[x+c].innerHTML=k[x+c].innerHTML=="O" && k[x+c].style.color=="blue"?"OO":"O";
									k[x+c].style.color="blue";
									d.innerHTML="TURN:Player A";
									b.innerHTML="";
							}
							else
							{
								k[x].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player A";
								m=false;
							}
							k[x].removeEventListener("click",func1);
							k[y].removeEventListener("click",func2);
					}
					function func2()
					{
							if(y+c<28)
							{
									k[y].innerHTML="";
									s=k[y+c].innerHTML;
									color=k[y+c].style.color;
									if(s=="O" && color=="red")
									{
										if(lockerA.innerHTML=="O")
											lockerA.innerHTML="OO";
										else
											lockerA.innerHTML="O";
									}
									if(s=="OO" && color=="red")
										lockerA.innerHTML="OO";
									k[y+c].innerHTML=k[y+c].innerHTML=="O" && k[y+c].style.color=="blue"?"OO":"O";
									k[y+c].style.color="blue";
									d.innerHTML="TURN:Player A";
									b.innerHTML="";
							}
							else
							{
								k[y].innerHTML="";
								b.innerHTML="";
								d.innerHTML="TURN:Player A";
								m=false;
							}
							k[x].removeEventListener("click",func1);
							k[y].removeEventListener("click",func2);
					}
				}	
			}
				
		}
		else
		{
			if(c==6)
			{
				if(lockerB.innerHTML=="O")
				{
					lockerB.innerHTML="";
					s=document.getElementsByClassName("b15")[0].innerHTML;
					color=document.getElementsByClassName("b15")[0].style.color;
					if(s=="O" && color=="red")
					{
						if(lockerA.innerHTML="O")
							lockerA.innerHTML="OO";
						else
							lockerA.innerHTML="O";
					}
					if(s=="OO" && color=="red")
						lockerA.innerHTML="OO";
					document.getElementsByClassName("b15")[0].innerHTML="O";
					document.getElementsByClassName("b15")[0].style.color="blue";
					setTimeout(myFunction,500,b,"",d,"TURN:Player B");
				}	
				else
				{
					var ind;
					k.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="blue")
							ind=index;
					}
							if((ind+6)==28)
							{
								k[ind].innerHTML="";
								blinktext("b");
								a.removeEventListener("click",randomNum);
								button.removeEventListener("click",validateForm);
							}
							else if((ind+6)<28)
							{
								k[ind].innerHTML="";
								s=k[ind+6].innerHTML;
								color=k[ind+c].style.color;
								if(s=="O" && color=="red")
								{
									if(lockerA.innerHTML=="O")
										lockerA.innerHTML="OO";
									else
										lockerA.innerHTML="O";
								}
								if(s=="OO" && color=="red")
									lockerA.innerHTML="OO";
								k[ind+6].innerHTML="O";
								k[ind+6].style.color="blue";
								setTimeout(myFunction,500,b,"",d,"TURN:Player B");
							}
							else
								setTimeout(myFunction,500,b,"",d,"TURN:Player B");
				}			
			}
			else
			{
				if(lockerB.innerHTML=="O")
					setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				else
				{
					var ind;
					k.forEach(changeValue);
					function changeValue(item,index)
					{
						if(item.innerHTML=="O" && item.style.color=="blue")
							ind=index;
					}
							if(ind+c==28)
							{
								k[ind].innerHTML="";
								blinktext("b");
								a.removeEventListener("click",randomNum);
								button.removeEventListener("click",randomNum);
							}
							else if(ind+c<28)
							{
								k[ind].innerHTML="";
								s=k[ind+c].innerHTML;
								color=k[ind+c].style.color;
								if(s=="O" && color=="red")
								{
									if(lockerA.innerHTML=="O")
										lockerA.innerHTML="OO";
									else
										lockerA.innerHTML="O";
								}
								if(s=="OO" && color=="red")
									lockerA.innerHTML="OO";
								k[ind+c].innerHTML="O";
								k[ind+c].style.color="blue";
								setTimeout(myFunction,500,b,"",d,"TURN:Player A");
							}
							else
								setTimeout(myFunction,500,b,"",d,"TURN:Player A");
				}
			}
		}
	}
}