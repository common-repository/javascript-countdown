/*
www.iTx-Technologies.com
*/

function calculateur(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (ZeroDevant && s.length < 2)
    s = "0" + s;
  return  s;
}

function AfficheTemps(secs) {
  if (secs < 0) {
    document.getElementById("compteur").innerHTML = ActionFinale;
    return;
  }
  DisplayStr = FormatAffichage.replace(/%%D%%/g, calculateur(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calculateur(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calculateur(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calculateur(secs,1,60));
  
  document.getElementById("compteur").innerHTML = DisplayStr;
  if (CompteurActif)
    setTimeout("AfficheTemps(" + (secs+Interval) + ")", SetTimeOutPeriod);
}

function formatTemps(backcolor, forecolor) {
  document.write("<div style='text-align:center'><span id='compteur' style='background-color:" + backcolor + 
  "; color:" + forecolor + "'></span></div>");
}

Interval = Math.ceil(Interval);
if (Interval == 0)
  CompteurActif = false;
var SetTimeOutPeriod = (Math.abs(Interval)-1)*1000 + 990;
formatTemps(CouleurBG, CouleurTexte);
var dthen = new Date(DateFinale);
var dnow = new Date();
if(Interval>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);
AfficheTemps(gsecs);