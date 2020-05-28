
<?php echo view('componentes/navbar'); ?>

<!-- SCRIPTS -->


<div class="container py-4" style="margin-top:70px;">

	
	<div class="row">		
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
	<div class="row mt-5" >
		<div class="col-md-12">
			<div class="card p-4" style="max-height: 700px;" >
				<div class="row">
					 <div class="col-md-2">
					 	<label>Mês</label>	
						<select class="form-control" name="mes_01">
							<option value="00">Escolha o mês</option>
							<option value="01">Janeiro</option>
							<option value="02">Fevereiro</option>
							<option value="03">Março</option>
							<option value="04">Abril</option>
							<option value="05">Maio</option>
							<option value="06">Junho</option>
							<option value="07">Julho</option>
							<option value="08">Agosto</option>
							<option value="09">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
						</select>
					</div> 
					<div class="col-md-2">
						<label>Data Inicial</label>
						<input type="text" name="data_inicial_01" class="form-control" placeholder="ex: 05">						
					</div>
					<div class="col-md-2">		
						<label>Data Final</label>				
						<input type="text" name="data_final_01"  class="form-control"
						placeholder="ex: 05">
					</div>
					<div class="col-md-2">
						<label>Buscar</label>	
						<button onclick="filtrar_grafico_01()" class="form-control btn-primary">Filtrar
						</button>
					</div>
					<div class="col-md-2">
						<label>Limpar</label>	
						<button onclick="limpar_filtro_01()" class="form-control btn-warning">Limpar
						</button>
					</div>				
				</div>				
				  <div id="sensor_01" class="w-100" style="height: 500px;"></div>
			</div>
		</div>	
	</div>
	<div class="row mt-5" >
		<div class="col-md-12">
			<div class="card p-4" >
				<div class="row">
					 <div class="col-md-2">
					 	<label>Mês</label>	
						<select class="form-control" name="mes_02">
							<option value="00">Escolha o mês</option>
							<option value="01">Janeiro</option>
							<option value="02">Fevereiro</option>
							<option value="03">Março</option>
							<option value="04">Abril</option>
							<option value="05">Maio</option>
							<option value="06">Junho</option>
							<option value="07">Julho</option>
							<option value="08">Agosto</option>
							<option value="09">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
						</select>
					</div> 
					<div class="col-md-2">
						<label>Data Inicial</label>
						<input type="text" name="data_inicial_02" class="form-control" placeholder="ex: 05">						
					</div>
					<div class="col-md-2">		
						<label>Data Final</label>				
						<input type="text" name="data_final_02"  class="form-control"
						placeholder="ex: 05">
					</div>
					<div class="col-md-2">
						<label>Buscar</label>	
						<button onclick="filtrar_grafico_02(500)" class="form-control btn-primary">Filtrar
						</button>
					</div>
					<div class="col-md-2">
						<label>Limpar</label>	
						<button onclick="limpar_filtro_02()" class="form-control btn-warning">Limpar
						</button>
					</div>							
				</div>				
				  <div id="sensor_02" style="height: 500px;"></div>
			</div>
		</div>
	</div>
	  <!-- <div id="sensor_01" style="height: 500px;"></div> -->
</div>






<script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(filtrar_grafico_01());
google.charts.setOnLoadCallback(filtrar_grafico_02());

function filtrar_grafico_01(){
	var quantidade = 500;
	var mes = $('select[name=mes_01]').val();
	var data_inicial = $('[name=data_inicial_01]').val();
	var data_final = $('[name=data_final_01]').val();

	grafico_01(quantidade,mes, data_inicial, data_final)
}

function filtrar_grafico_02(){
	var quantidade = 500;
	var mes = $('select[name=mes_02]').val();
	var data_inicial = $('[name=data_inicial_02]').val();
	var data_final = $('[name=data_final_02]').val();

	grafico_02(quantidade,mes, data_inicial, data_final)
}






async function ler_sensores(quantidade, mes, data_inicial, data_final){
	//primeira vez que entra
	if(mes == "00"){
		mes = data_inicial = data_final = '0';
	}
	console.log("valores")
	console.log(quantidade + mes + data_final + data_inicial)
	
	var medidas = null;
    medidas = $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_estacoes/ler_sensores/");?>"+ quantidade + "/"+ mes + "/"+data_inicial + "/" + 	data_final ,
		success:function(response){
			return response
		},
		error: function(err) {console.log(err)} 
	})
	return medidas	
}




async function grafico_01(quantidade, mes, data_inicial, data_final) {

    var medidas = await ler_sensores(quantidade,mes, data_inicial, data_final)
	
    var data = new google.visualization.DataTable();
    dateFormatter = new google.visualization.DateFormat();
    
    data.addColumn('datetime', 'Periodo');
    data.addColumn('number', 'Temperatura');
	
	dataRows = []
	medidas = medidas.reverse()
	for (var i = 0; i < medidas.length; i++) {	
		 // new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5])); padrao americano
		var t = medidas[i].data_upload.split(/[- :]/);
		var data_hora = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
	 	dataRows.push([
	    	data_hora, 
	    	parseFloat( medidas[i].temperatura) 
	    ]);	
	} 	
 	data.addRows(dataRows)

	var options = {
	    // title: 'Temperatura',
        curveType: 'function',
        legend: { position: 'top' },
	     	
	    hAxis: {
	    	//format:'hh:mm a',
	    	textStyle : {
            	fontSize: 12 // or the number you want
        	},
        	
        	viewWindow: {
        		min: dataRows[0][0],
        		max: dataRows[dataRows.length - 1][0]
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
	    vAxis: {
	    	title: 'Temperatura (°C)'
	    }

	};


	var chart = new google.visualization.LineChart(document.getElementById('sensor_01'));
	//var chart = new google.charts.Line(document.getElementById('sensor_01'));

	chart.draw(data, options);
}




//GRAFICO 2
async function grafico_02(quantidade, mes, data_inicial, data_final) {

    var medidas = await ler_sensores(quantidade,mes, data_inicial, data_final)
	
    var data = new google.visualization.DataTable();
    dateFormatter = new google.visualization.DateFormat();
    
    data.addColumn('datetime', 'Periodo');
    data.addColumn('number', 'Umidade do Solo');
	
	dataRows = []
	medidas = medidas.reverse()
	for (var i = 0; i < medidas.length; i++) {	
 		var t = medidas[i].data_upload.split(/[- :]/);
		var data_hora = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
	 	dataRows.push([
	    	data_hora, 
	    	parseFloat( medidas[i].umidade) 
	    ]);	   
	} 	
 	data.addRows(dataRows)

	var options = {
	    // title: 'Temperatura',
	    colors: ['#e0440e'],
        curveType: 'function',
        legend: { position: 'top' },
	     	
	    hAxis: {
	    	//format:'hh:mm a',
	    	textStyle : {
            	fontSize: 12 // or the number you want
        	},
        	
        	viewWindow: {
        		min: dataRows[0][0],
        		max: dataRows[dataRows.length - 1][0]
        	},
        	gridlines: {
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
	    vAxis: {
	    	title: 'Umidade do solo (%)'
	    }

	};

	var chart = new google.visualization.LineChart(document.getElementById('sensor_02'));
	//var chart = new google.charts.Line(document.getElementById('sensor_01'));

	chart.draw(data, options);
}



function atualizar () {
	// $('select[name=mes_01]').val('00');
	// $('[name=data_inicial_01]').val();
	// $('[name=data_final_01]').val();
	// $('select[name=mes_02]').val('00');
	// $('[name=data_inicial_02]').val();
	// $('[name=data_final_02]').val();
	filtrar_grafico_01()
	filtrar_grafico_02()

	setTimeout(atualizar, 15000);
}



function limpar_filtro_01(){
	$('select[name=mes_01]').val('00');
	$('[name=data_inicial_01]').val('');
	$('[name=data_final_01]').val('');
	filtrar_grafico_01()
}

function limpar_filtro_02(){
	$('select[name=mes_02]').val('00');
	$('[name=data_inicial_02]').val('');
	$('[name=data_final_02]').val('');
	filtrar_grafico_02()
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

		}
	})
}



$(document).ready(function(){
	atualizar()
	get_on_off_estado();
	var estado = 0;
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
		$.ajax({
			type:'POST',
			url:"<?=site_url("Api/Api_acoes/On_Off/");?>" + estado,
			success:function(data){
				console.log(data);

			}
		})	      
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
		console.log(canal + limite_inferior + limite_superior)
		$.ajax({
			type:'POST',
			url:"<?=site_url("Api/Api_acoes/Limite/");?>" + estado + "/" + canal + "/"+limite_inferior + "/" + limite_superior ,
			success:function(data){
				console.log(data);
			}
		})	  
 
    })

    var estado = 0;
	$('#toggle-deep-sleep').change(function() {
		if($(this).prop('checked')){
			console.log('ligado')
						$('#toggle-on-off').bootstrapToggle('off')
			$('#toggle-limite').bootstrapToggle('off')
			$(".disable-card-on-off").removeClass('d-none');
			$(".disable-card-limites").removeClass('d-none');

			estado = 3;
		} else {
			estado = 0;
			console.log('desligado')
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
});






</script>
</body>
</html>