
<?php echo view('componentes/navbar'); ?>

<!-- SCRIPTS -->


<div class="container py-4" style="margin-top:70px;">

	
	<div class="row">
		<div class="col-md-6">
			<div class="card">

				<div class="row p-2">
					<div class="col-md-12">
						<h5>Ligar Saída ON/OFF</h5>
					</div>

					<!-- <div class="col-md-2">
						<button onclick="ligar_on_off() " >Acionar ON/OFF</button>
					</div> -->
					<div class="col-md-2">
						<input type="checkbox" id="toggle-on-off"  data-toggle="toggle">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-5" >
		<div class="col-md-12">
			<div class="card p-4" >
				<div class="row">
					 <div class="col-md-2">
					 	<label>Mês</label>	
						<select class="form-control" name="mes_temperatura">
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
						<input type="text" name="data_inicial" class="form-control" placeholder="ex: 05">						
					</div>
					<div class="col-md-2">		
						<label>Data Final</label>				
						<input type="text" name="data_final"  class="form-control"
						placeholder="ex: 05">
					</div>
					<div class="col-md-2">
						<label>Buscar</label>	
						<button onclick="filtrar_temperatura()" class="form-control btn-primary">Filtrar
						</button>
					</div>
					<div class="col-md-1"></div>				
				</div>				
				<canvas id="temperatura_grafico" height="500"></canvas>
			</div>
		</div>	
	</div>
	<div class="row mt-5" >
		<div class="col-md-12">
			<div class="card" >
				<canvas id="umidade_grafico" height="500"></canvas>
			</div>
		</div>
	</div>
</div>






<script type="text/javascript">


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




$(document).ready(function(){
	get_dados_api();


	get_on_off_estado();




	


	var estado = 0;
	$('#toggle-on-off').change(function() {
		if($(this).prop('checked')){
			console.log('ligado')
			estado = 1;
		} else {
			estado = 0;
			console.log('desligado')
		}


		$.ajax({
			type:'POST',
			url:"<?=site_url("Api/Api_acoes/On_Off/");?>" + estado,
			success:function(data){
				console.log(data);

			}
		})
	      
    })

});



function get_on_off_estado(){
	$.ajax({
		type:'GET',
		url:"<?=site_url("Api/Api_acoes/get_On_Off");?>",
		success:function(data){
			if(data[0].medir == 1) {
				console.log('ligado')
				$('#toggle-on-off').bootstrapToggle('on')
			}else {
				console.log('desligado')
			}

		}
	})
}


function get_dados_api(){
	var periodo = [];
	var temperatura = []; 
	var umidade = []; 

    console.log("onready")
    $.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_estacoes");?>",
		success:function(data){
			console.log(data);

			data.map(function (val){
				temperatura.push(val.temperatura);
				umidade.push(val.umidade);
				periodo.push(val.data_upload);
			})

			
			ver_temperatura(temperatura,periodo)
			ver_umidade(umidade,periodo)
		}
	})
}




function filtrar_temperatura(){

	var periodo = [];
	var temperatura = []; 
	var umidade = []; 

	var mes = $('select[name=mes_temperatura]').val();
	var data_inicial = $('[name=data_inicial]').val();
	var data_final = $('[name=data_final]').val();


	$.ajax({
		type:'POST',
		url:"<?=site_url("Api/Api_estacoes/Api_filtrar_temperatura/");?>" + mes + "/"+data_inicial + "/" + data_final ,
		success:function(data){
			console.log(data);

			data.map(function (val){
				temperatura.push(val.temperatura);
				umidade.push(val.umidade);
				periodo.push(val.data_upload);
			})


			ver_temperatura(temperatura,periodo)
			ver_umidade(umidade,periodo)

			
	
		}
	})
	
}


var chart;
function ver_temperatura(temperatura,periodo){

	console.log("cortar periodo")
	//periodo = periodo.slice(0,20)
	console.log(periodo)
	//temperatura = temperatura.slice(0,20)


	if (chart) {
        chart.destroy();
         console.log(chart)
        console.log("Existe chart")
    }




	var ctx = document.getElementById('temperatura_grafico').getContext('2d');
	


	chart = new Chart(ctx, {
	    // The type of chart we want to create
	    type: 'line',

	    // The data for our dataset
	    data: {
	        labels: periodo.reverse(),
	        datasets: [{
	            label: 'Temperatura',
	            backgroundColor: 'transparent',
	            borderColor: 'green',
	            data: temperatura.reverse()
	        }]
	    },

	    // Configuration options go here
	    options: {
	    	 showXLabels: 10,
    		title: {
				display: true,
				text: 'Gráfico Temperatura '
			},
	    	scales: {
		        yAxes: [{
		        	display: true,
		            ticks: {
		            	max: 70,
		                beginAtZero:true
		            }
		        }],
		         xAxes: [{
		            ticks: {
		                autoSkip:true,
		                maxTicksLimit:20
		            }, 
		              scaleLabel: {
		                display: true,
		                labelString: "Período"
		              }
            	}],
		     	
	   		 }
	    }
	});

}







function ver_umidade(umidade,periodo){

	if (chart_umidade) {
        chart_umidade.destroy();
        console.log("Existe chart")
    }

	var ctx_umidade = document.getElementById('umidade_grafico').getContext('2d');
	var chart_umidade = new Chart(ctx_umidade, {
		// The type of chart we want to create
		type: 'line', // also try bar or other graph types

		// The data for our dataset
		data: {
			labels: periodo,
			// Information about the dataset
	    datasets: [{
				label: "Umidade",
				backgroundColor: 'transparent',
				borderColor: 'royalblue',
				borderWidth: 1,
				data: umidade,
			}]
		},

		// Configuration options
		options: {
			   responsive: true,
		    layout: {
		      padding: 10,
		    },
			legend: {
				position: 'bottom',
			},
			title: {
				display: true,
				text: 'Gráfico Umidade (nao esta funcionando ainda)'
			},
		
			scales: {
		        yAxes: [{
		        	display: true,
		            ticks: {
		            	max: 200,
		                beginAtZero:true
		            }
		        }]
	   		 }
		}
	});
}


</script>
</body>
</html>