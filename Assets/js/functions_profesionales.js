const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
//const bullet = document.querySelectorAll(".step .bullet");


document.addEventListener('DOMContentLoaded',function(){

    tableprofesionales = $('#tableprofesionales').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Profesionales/getProfesionales",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_profesional"},
            {"data":"cedula_p"},
            {"data":"nombre_p"},
            {"data":"apellido_p"},
            {"data":"email_profesional"},
            {"data":"num_celular_p"},
            {"data":"profesion"},
            {"data":"gremio"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]] 
    });

    if(document.querySelector("#foto")){
        var foto = document.querySelector("#foto");
        foto.onchange = function(e) {
            var uploadFoto = document.querySelector("#foto").value;
            var fileimg = document.querySelector("#foto").files;
            var nav = window.URL || window.webkitURL;
            var contactAlert = document.querySelector('#form_alert');
            if(uploadFoto !=''){
                var type = fileimg[0].type;
                var name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value="";
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        if(document.querySelector('#img')){
                            document.querySelector('#img').remove();
                        }
                        document.querySelector('.delPhoto').classList.remove("notBlock");
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                    }
            }else{
                alert("No selecciono foto");
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
            }
        }
    }

    if(document.querySelector(".delPhoto")){
        var delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            removePhoto();
        }
    }

        $(function(){
        $("#txtDateInstrucion").datepicker({
            format: "yyyy-mm-dd",
            startView: 2,
            minViewMode: 1,
            language: "es",
            autoclose: true
        });
        $("#txtDatecargoini").datepicker({
            format: "yyyy-mm-dd",
            startView: 2,
            minViewMode: 1,
            language: "es",
            autoclose: true
        });
        $("#txtDatecargofin").datepicker({
            format: "yyyy-mm-dd",
            startView: 2,
            minViewMode: 1,
            language: "es",
            autoclose: true
        });

        });
    //nuevo profesional
    var formProfesionales = document.querySelector("#formProfesional");
    formProfesionales.onsubmit = function(e) {//evita que se recargue la pagina y llama a la funcion
        e.preventDefault();
        /*--------------page informacion personal-----------------*/
        var intIdRol = document.querySelector('#idProfesional').value;
        var strIdentificacion = document.querySelector('#txtIdentificacion').value;
        var strEmail = document.querySelector('#txtEmail').value;
        let strPassword = document.querySelector('#txtPassword').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value; 
        var intIdProfesion = document.querySelector('#listProfid').value; 
        var intIdGremio = document.querySelector('#listGremid').value; 
        var strDireccion = document.querySelector('#txtDireccion').value; 
        var intTelefono = document.querySelector('#txtTelefono').value;
        /*--------------page informacion academica-----------------*/ 
        var intIdInstrucion = document.querySelector('#listIntruccionid').value;
        var strNombreInstitucion = document.querySelector('#txtNombreInstitucion').value; 
        var strDateInstrucion = $('#txtDateInstrucion').val();
        var strTitulo = document.querySelector('#txtTitulo').value; 
        var strOtrasAct = document.querySelector('#txtOtrasAct').value;
        /*--------------page experiencia profesional-----------------*/
        var strCargo = document.querySelector('#txtCargo').value;
        var strEmpresa = document.querySelector('#txtEmpresa').value;
        var strDatecargoIni = $('txtDatecargoini').datepicker('getDate');
        var strDatecargoFin = $('txtDatecargofin').datepicker('getDate');
        var strDescripcion = document.getElementById("txtDescripcionAct").value; 
        /*----------Referencias personales--------------*/
        var strNombreRef = document.querySelector('#txtNombreRef').value;
        var strApellidoRef = document.querySelector('#txtApellidoRef').value; 
        var intTelefonoRef = document.querySelector('#txtTelefonoRef').value;
        var strEmailRef = document.querySelector('#txtEmailRef').value;

        if(strIdentificacion == '' || strEmail== '' || strNombre == '' || strApellido == '' || intIdProfesion == '' || intIdGremio == '' || intTelefono == '' 
            || strDireccion == '' || intIdInstrucion == '' || strNombreInstitucion== '' || strDateInstrucion == ''
            || strTitulo == ''|| strCargo == ''|| strEmpresa == ''|| strDatecargoIni == ''|| strDatecargoFin == '' || strNombreRef == '' || strApellidoRef == '' || intTelefonoRef == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        /*detecta que navegador se esta usando con una validacion, si es asi crea un nuevo elemento XMLHttpRequest()
        de lo contrario cre un nuevo objeto de ActiveXObject de Microsoft.XMLHTTP*/
        divLoading.style.display="flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Profesionales/setProfesional'; //creamos la url donde nos dirigimos a la funcion setrol
        var formData = new FormData(formProfesionales);//crea un nuevo objeto, haciendo referencia a formRol

        request.open("POST",ajaxUrl,true);
        request.send(formData);//envio de datos por medio de ajax, refiriendonos a request
        request.onreadystatechange=function(){
            if (request.readyState  == 4 && request.responseText==200) {
                var objData =JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormProfesionales').modal("hide");
                    formProfesionales.reset();
                    swal("Profesionales", objData.msg ,"success");
                    tableRoles.api().ajax.reload();
                }else{
                    swal("Error", objData.msg, "error");
                }                        
            }    
            divLoading.style.display = "none";
                return false;
        }
    }
},false);

window.addEventListener('load', function() {
    fntProfesion();
    fntGremio();
    // body...





},false)

function fntProfesion(){
    if(document.querySelector('#listProfid')){
        let ajaxUrl = base_url+'/Profesionales/getSelectProfesion';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listProfid').innerHTML = request.responseText;
                $('#listProfid').selectpicker('render');
            }
        }
    }
}

function fntGremio(){
    if(document.querySelector('#listGremid')){
        let ajaxUrl = base_url+'/Profesionales/getSelectGremio';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listGremid').innerHTML = request.responseText;
                $('#listGremid').selectpicker('render');
            }
        }
    }
    
}
function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    document.querySelector('#img').remove();
}
let current = 1;
nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  /*bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");*/
  current += 1;
});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  /*bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");*/
  current += 1;
});
nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  /*bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");*/
  current += 1;
});
/*submitBtn.addEventListener("click", function(){
  /*bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  setTimeout(function(){
    alert("Your Form Successfully Signed up");
    location.reload();
  },800);
});*/

prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  /*bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");*/
  current -= 1;
});
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  /*bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");*/
  current -= 1;
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  /*bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");*/
  current -= 1;
});



function openModal()
{
    document.querySelector('#idProfesional').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Profesional";
    document.querySelector("#formProfesional").reset();
    $('#modalFormProfesionales').modal('show');
}