var initialtab=[1, "sc01"]
var turntosingle=0
var disabletablinks=0

var previoustab=""

if (turntosingle==1)
document.write('<style type="text/css">\n#tabcontentcontainer{display: none;}\n</style>')

function expandcontent(cid, aobject){
	if (disabletablinks==1)
	aobject.onclick=new Function("return false")
	if (document.getElementById && turntosingle==0){
		highlighttab(aobject)
		if (previoustab!="")
		document.getElementById(previoustab).style.display="none"
		if (cid!=""){
			document.getElementById(cid).style.display="block"
			previoustab=cid
		}
	}
}

function highlighttab(aobject){
	if (typeof tabobjlinks=="undefined")
	collecttabmenu()
	for (i=0; i<tabobjlinks.length; i++)
	tabobjlinks[i].className=""
	aobject.className="current"
}

function collecttabmenu(){
	var tabobj=document.getElementById("tabmenu")
	tabobjlinks=tabobj.getElementsByTagName("A")
}

function do_onload(){
	collecttabmenu()
	expandcontent(initialtab[1], tabobjlinks[initialtab[0]-1])
}

if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload