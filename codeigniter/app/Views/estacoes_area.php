<?php echo view('componentes/navbar'); ?>
<div id="preloader" class="d-none">      
    <div id="loader"></div>      
</div>
<div class="container py-4" style="margin-top:70px;">
	<div class="row ">		
		<div class="col-md-2">
			<div class="card h-100">
				<div class="row p-2">
					<div class="col-md-12">
						<h5>DeepSleep</h5>
					</div>

					<div class="col-md-2">
						<label>Ativar</label>
						<input type="checkbox" id="toggle-deep-sleep"  data-toggle="toggle">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card h-100">
				<div class="disable-card-on-off d-none" 
				style="    
					width: 100%;
				    height: 100%;
				    position: absolute;
				    background: #00000054;
				    z-index: 2;
				    border: none;
				    cursor: not-allowed;">			    	
			    </div>
				<div class="row p-2">
					<div class="col-md-12">
						<h5>ON/OFF</h5>
					</div>

					<div class="col-md-2">
						<label>Ativar</label>
						<input type="checkbox" id="toggle-on-off"  data-toggle="toggle">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="disable-card-limites d-none" style="    width: 100%;
    height: 100%;
    position: absolute;
    background: #00000054;
    z-index: 2;
    border: none;
    cursor: not-allowed;"></div>
				<div class="row p-2">
					<div class="col-md-12">
						<h5>Definir Limite</h5>
					</div>
					<div class="col-md-4">
						<label>Canal</label>	
						<select class="form-control" name="canal">
							<option value="00">Escolha o canal</option>
							<option value="1">Canal 01</option>
							<option value="2">Canal 02</option>
						</select>
					</div>
					<div class="col-md-3">
						<label>Limite Inferior</label>
						<input type="text" name="limite_inferior" class="form-control" placeholder="ex: 10">	
					</div>
					<div class="col-md-3">
						<label>Limite Superior</label>
						<input type="text" name="limite_superior" class="form-control" placeholder="ex: 30">	
					</div>
					<div class="col-md-2">
						<label>Ativar</label>
						<input type="checkbox" id="toggle-limite"  data-toggle="toggle">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-md-12">
			<div class="card p-4">
				<div class="row">
					<div class="col-md-12 d-flex ">
				   	<div class="form-group pr-2">
		          <label class="">Data inicial:</label>
		          <div class='input-group date' id='datetimepicker1'>
		              <input type='text' name="data_inicial" class="form-control form-control-sm rounded-0 w-50" />
		              <span class="input-group-addon">
		              </span>
		          </div>
		        </div>
		        <div class="form-group pr-2 ">
		          <label>Data Final:</label>
		          <div class='input-group date' id='datetimepicker2'>
		              <input type='text' name="data_final" class="form-control form-control-sm rounded-0 w-50" />
		              <span class="input-group-addon">
		              </span>
		          </div>
		        </div>
		        <div class="form-group pr-2">
      				<label>Buscar</label>	
      				<div class='input-group'>
		            <button type="button" onclick="filtrar_grafico()" class="form-control form-control-sm px-5 btn-primary">Filtrar</button>
		          </div>							
						</div>
						<div class="form-group pr-2">
							<label>Limpar</label>
							<div class='input-group'>
	            	<button type="button" onclick="limpar_filtro()" class="form-control form-control-sm px-5 btn-warning">Limpar</button>
		          </div>							
						</div>
					</div> 	
				</div>		
			</div>
		</div>
	</div>
	<div class="row mt-5" >
		<div class="col-md-12">
			<div class="card p-4"  >						
			  <div id="sensor_01" class="w-100" ></div>
			</div>
		</div>	
	</div>
		<div class="row mt-5" >
		<div class="col-md-12">
			<div class="card p-4" >						
			  <div id="sensor_02" class="w-100" ></div>
			</div>
		</div>	
	</div>
	<div class="row mt-5 " >
		<div class="col-md-12">
			<div class="card p-4" >
				<div class="row">
					<div class="col-md-6">
						<p class="">Tempo das medidas (mínimo 1 minuto):</p><input type="text" placeholder="segundos" class="form-control w-25 float-left mr-4" name="name-tempo-medidas">
						<button type="button" onclick="tempo_leituras()" class="float-left form-control btn-warning w-25">Salvar</button>
					</div>
					 <div class="col-md-6">
					 	<p>Bateria carregada: <span id="js-tensao-bateria"></span> %</p>
					 </div>
				</div>
			</div>
		</div>
	</div>	
</div>

<script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'line']});
google.load('visualization', '1.0', {'packages':['gauge']});
google.charts.load('current', {'packages':['corechart']});


$(document).ready(function(e){

	loader(true)
  $('#datetimepicker1').datetimepicker({
    allowInputToggle: true,
    format:'DD-MM-YYYY HH:mm',
  });
  $('#datetimepicker2').datetimepicker({
    allowInputToggle: true,
    format:'DD-MM-YYYY HH:mm',
  });

  google.charts.setOnLoadCallback(leituras_iniciais);



	get_on_off_estado();
	get_tempo_leituras();
	var estado = 0;
	var nao_fazer_requisicao_acoes = false
	$('#toggle-on-off').change(function() {
		if($(this).prop('checked')){
			console.log('ligado')
			$(".disable-card-limites").removeClass('d-none');
			estado = 1;
		} else {
			estado = 0;
			console.log('desligado')
			$(".disable-card-limites").addClass('d-none');
		}

		if(nao_fazer_requisicao_acoes == false){
			$.ajax({
				type:'POST',
				url:"<?=site_url("Api/Api_acoes/On_Off/");?>" + estado,
				success:function(data){
					console.log(data);
				}
			})	  
		}    
  })


	var estado = 0;
	$('#toggle-limite').change(function() {

		if($(this).prop('checked')){
			console.log('ligado')
			$(".disable-card-on-off").removeClass('d-none');
			var limite_inferior = $('[name=limite_inferior]').val();
			var limite_superior = $('[name=limite_superior]').val();
			estado = 2;
		} else {
			estado = 0;
			console.log('desligado')
			$(".disable-card-on-off").addClass('d-none');
			var limite_inferior = 0;
			var limite_superior = 0;
		}
		var canal = $('select[name=canal]').val();
		
		if(nao_fazer_requisicao_acoes == false){
			$.ajax({
				type:'POST',
				url:"<?=site_url("Api/Api_acoes/Limite/");?>" + estado + "/" + canal + "/"+limite_inferior + "/" + limite_superior ,
				success:function(data){
					console.log(data);
				}
			}) 
		}
 
  })

 	var estado = 0;
   
	$('#toggle-deep-sleep').change(function() {
		if($(this).prop('checked')){
			console.log('ligado')
			nao_fazer_requisicao_acoes = true
			$('#toggle-on-off').bootstrapToggle('off')
			$('#toggle-limite').bootstrapToggle('off')
			$(".disable-card-on-off").removeClass('d-none');
			$(".disable-card-limites").removeClass('d-none');

			estado = 3;
		} else {
			estado = 0;
			console.log('desligado')
			nao_fazer_requisicao_acoes = false
			$(".disable-card-on-off").addClass('d-none');
			$(".disable-card-limites").addClass('d-none');
		}

		$.ajax({
			type:'POST',
			url:"<?=site_url("Api/Api_acoes/DeepSleep/");?>" + estado,
			success:function(data){
				console.log(data);

			}
		}) 
  })
 	return false
	 
});




async function filtrar_grafico(){
	loader(true)
  var medidas = await  filtrarPeriodoSensor()
  if(medidas.length > 0){
    nao_atualizar = true
    grafico_01(medidas) 
    grafico_02(medidas)
    loader(false)
 
  }else{
    alert("Não possui medidas para o período selecionado")
    loader(false)
  }
}


function filtrarPeriodoSensor(){ 
 	var formData = new FormData();
  var data_inicial = $('[name="data_inicial"]').val()
  var data_final = $('[name="data_final"]').val()

  formData.append('data_inicial',data_inicial);
  formData.append('data_final',data_final);

  var medidas = null;
  medidas = $.ajax({
    type:'POST',
    url:"<?=site_url("api/Api_estacoes/filtrar_sensores");?>",
    data: formData,
    processData: false,
    contentType: false,
    success:function(response){            
      return response  
    },
    error: function(err) {console.log(err)} 
  })
  return medidas  

}




var resposta_sensores = [];
async function leituras_iniciais(){
    var medidas = await  ler_sensores(0)
    resposta_sensores = medidas
    grafico_01(medidas) 
    grafico_02(medidas) 
    ler_bateria()
    loader(false)
    setTimeout(atualizando_sensores, 15000);
}

async function ler_sensores(busca){
      
    var medidas = null;
    medidas = $.ajax({
        type:'POST',
        url:"<?=site_url("api/Api_estacoes/ler_sensores/");?>" + busca ,
        success:function(response){            
            return response
        },
        error: function(err) {console.log(err)} 
    })
    return medidas  
}



var nao_atualizar = false
async function atualizando_sensores(){
  if(nao_atualizar == false){
    var medidas = await  ler_sensores(1)
    if(medidas[0].id != resposta_sensores[0].id){
        resposta_sensores = medidas.concat(resposta_sensores)
        grafico_01(resposta_sensores)
        grafico_02(resposta_sensores)  
        ler_bateria()
    } else {
    }
    setTimeout(atualizando_sensores, 15000);
  }
}



//Temperatura
async function grafico_01(medidas) {
   
    var data = new google.visualization.DataTable();
    dateFormatter = new google.visualization.DateFormat();
    
    data.addColumn('datetime', 'Periodo');
    data.addColumn('number', 'Temperatura (°C)');
     
    dataRows = []
    for (var i = 0; i < medidas.length; i++) {  
        var t = medidas[i].data_upload.replace("_", " ").split(/[- :]/);
        var data_hora = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
        dataRows.push([
            data_hora, 
            parseFloat( medidas[i].temperatura) 
        ]); 
    }   
    data.addRows(dataRows)

    var data_final = new Date(dataRows[0][0].getTime()  + (5 *60*1000))

    var options = {
        colors: ['rgb(219, 68, 55)'],
        backgroundColor: { fill:'transparent' },
        width: '100%',  
        height:350,
        chartArea: {    
            left:40,
            width: '90%',
            height:'80%',
        },
        curveType: 'function',
        legend: { position: 'top' },            
        hAxis: {           
            textStyle : {
                fontSize: 12 
            },            
            viewWindow: {
                max : data_final                
            },
            gridlines: {
                count: 0,
                color: 'transparent',
                count: -1,
                units: {
                    days:{format: ['MMM dd']},
                    hours:{format: ['HH:mm']},
                }
            },
            minorGridlines: {
                units: {
                    hours: {format: ['hh:mm:ss', 'ha']},
                    minutes: {format: ['HH:mm ', 'HH:mm']}
                }
            },
        },
    };
    var chart = new google.visualization.AreaChart(document.getElementById('sensor_01'));
    chart.draw(data, options);
}


async function grafico_02(medidas) {
   
    var data = new google.visualization.DataTable();
    dateFormatter = new google.visualization.DateFormat();
    
    data.addColumn('datetime', 'Periodo');
    data.addColumn('number', 'Umidade (%)');
     
    dataRows = []
    for (var i = 0; i < medidas.length; i++) {  
        var t = medidas[i].data_upload.replace("_", " ").split(/[- :]/);
        var data_hora = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
        dataRows.push([
            data_hora, 
            parseFloat( medidas[i].umidade) 
        ]); 
    }   
    data.addRows(dataRows)

    var data_final = new Date(dataRows[0][0].getTime()  + (5 *60*1000))

    var options = {
        colors: ['rgb(0, 123, 255)'],
        backgroundColor: { fill:'transparent' },
        width: '100%',  
        height:350,
        chartArea: {    
            left:40,
            width: '90%',
            height:'80%',
        },
        curveType: 'function',
        legend: { position: 'top' },            
        hAxis: {           
            textStyle : {
                fontSize: 12 
            },            
            viewWindow: {
                max : data_final                
            },
            gridlines: {
                count: 0,
                color: 'transparent',
                count: -1,
                units: {
                    days:{format: ['MMM dd']},
                    hours:{format: ['HH:mm']},
                }
            },
            minorGridlines: {
                units: {
                    hours: {format: ['hh:mm:ss', 'ha']},
                    minutes: {format: ['HH:mm ', 'HH:mm']}
                }
            },
        },
    };
    var chart = new google.visualization.AreaChart(document.getElementById('sensor_02'));
    chart.draw(data, options);
}




function ler_bateria() {
	 $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_estacoes/ler_bateria");?>",
		success:function(response){
			$('#js-tensao-bateria').text(response[0].bateria)
		},
		error: function(err) {console.log(err)} 
	})
}

function limpar_filtro(){
  nao_atualizar = false
  $('[name="data_inicial"]').val('')
  $('[name="data_final"]').val('')
  leituras_iniciais()
}


//REFERENTE A SAIDAS
function realizar_medida(){
	console.log('clicou')
	 $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_acoes");?>",
		success:function(data){
			console.log(data);
		}
	})
}

function ligar_on_off(){
	console.log('clicou')
	 $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_acoes/On_Off");?>",
		success:function(data){
			console.log(data);

		}
	})
}

function get_on_off_estado(){
	$.ajax({
		type:'GET',
		url:"<?=site_url("Api/Api_acoes/get_On_Off");?>",
		success:function(data){
			if(data[0].medir == 1) {
				console.log('ligado')
				$('#toggle-on-off').bootstrapToggle('on')
				$(".disable-card-limites").removeClass('d-none');
			}else if (data[0].medir == 2) {
				$('#toggle-limite').bootstrapToggle('on')
				$(".disable-card-on-off").removeClass('d-none');

				$('select[name=canal]').val(data[0].canal);
				$('[name=limite_inferior]').val(data[0].limite_inferior);
				$('[name=limite_superior]').val(data[0].limite_superior);
			

			} else if(data[0].medir == 3){
				$('#toggle-deep-sleep').bootstrapToggle('on')
				$(".disable-card-on-off").removeClass('d-none');
				$(".disable-card-limites").removeClass('d-none');
			} else {
				console.log('desligado')
			}

			// realiza_leituras();
		}
	})
}



function tempo_leituras(){
	
	var tempo = $('input[name=name-tempo-medidas]').val();

	 $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_acoes/SalvarAgenda/");?>" + tempo,
		success:function(data){
			console.log(data);

		}
	})
}

function get_tempo_leituras(){
	 $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_acoes/TempoLeituras");?>",
		success:function(data){
			console.log(data);
			$('input[name=name-tempo-medidas]').val(data[0].tempo_leitura);


		}
	})

}





function loader(estado){
    if(estado == true){
        $('#preloader').removeClass('d-none')
    } else {
        $('#preloader').addClass('d-none')
    }
}






</script>
</body>
</html>