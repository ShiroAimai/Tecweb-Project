var precMesiVal=0; var precPuntiVal=0;


function changeMesi(){
var aux=document.getElementById('importo'); //valore attuale di importo
var confronto = precMesiVal-Number(document.getElementById('mesi').value); //mi dice se devo sommare o sottrarre dal valore attuale
precMesiVal=Number(document.getElementById('mesi').value); //mi salva l'ultimo valore assegnato a mesi
//console.log(confronto);
//console.log(precMesiVal);
if(confronto < 0)
	document.getElementById('importo').value=Number(aux.value)+40*(-1*confronto);
else if(confronto>0)
		document.getElementById('importo').value=Number(aux.value)-40*(confronto);
};

function changeEntrate(){
var aux=document.getElementById('importo'); //valore attuale di importo
var confronto = precPuntiVal-Number(document.getElementById('entrate').value); //mi dice se devo sommare o sottrarre dal valore attuale
precPuntiVal= document.getElementById('entrate').value; //mi salva l'ultimo valore assegnato a entrate
if(confronto<0)
	document.getElementById('importo').value=Number(aux.value)+6*(-1*confronto);
else if(confronto>0)
		document.getElementById('importo').value=Number(aux.value)-6*(confronto);
};
