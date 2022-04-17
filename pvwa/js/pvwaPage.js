/* ventana emergente de ayuda */

function popUp(URL) {
	day = new Date();
	id = day.getTime();
  
	//window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=300,left=540,top=250');
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=300,left=540,top=250');");
}

/* Validación de formulario */

function validate_required(field,alerttxt)
{
with (field) {
  if (value==null||value=="") {
    alert(alerttxt);return false;
  }
  else {
    return true;
  }
 }
}

function validateregistroForm(thisform) {
with (thisform) {

 // formulario de registro
  if (validate_required(txtName,"El nombre no puede estar vacío.")==false)
  {txtName.focus();return false;}
  
  if (validate_required(mtxMessage,"El mensaje no puede estar vacío.")==false)
  {mtxMessage.focus();return false;}
  
  }
}

function confirmClearregistro() {
	return confirm("¿Estás seguro de que quieres borrar el registro?");
}
