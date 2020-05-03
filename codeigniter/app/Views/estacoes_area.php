
<?php echo view('componentes/navbar'); ?>

<!-- SCRIPTS -->


<div class="container-fluid py-4" style="margin-top:70px;">

	
	<div class="row">
		<div class="col-md-3">
			<button onclick="ligar_on_off()">Acionar ON/OFF</button>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-6">
			<div class="card" >
				<div class="row p-2">
					<div class="col-md-4">
						<select class="form-control" onchange="filtro_mes_temperatura(this.value)">
							<option>Escolha o mês</option>
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
					<div class="col-md-4">
						<button onclick="get_dados_api()">
							Atualizar 
						</button>
					</div>
				</div>				
				<canvas id="temperatura_grafico" height="500"></canvas>
			</div>
		</div>
		<div class="col-md-6">
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

});



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




temperatura_filtro = []
function filtro_mes_temperatura(mes){
	
}



function ver_temperatura(temperatura,periodo){

	console.log("cortar periodo")
	periodo = periodo.slice(0,10)
	console.log(periodo)
	temperatura = temperatura.slice(0,10)


	var ctx = document.getElementById('temperatura_grafico').getContext('2d');
	var chart = new Chart(ctx, {
	    // The type of chart we want to create
	    type: 'line',

	    // The data for our dataset
	    data: {
	        labels: periodo.reverse(),
	        datasets: [{
	            label: 'Temperatura',
	            backgroundColor: 'transparent',
	            borderColor: 'rgb(255, 99, 132)',
	            data: temperatura.reverse()
	        }]
	    },

	    // Configuration options go here
	    options: {
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
		     	
	   		 }
	    }
	});
}







function ver_umidade(umidade,periodo){

	var ctx = document.getElementById('umidade_grafico').getContext('2d');
	var chart = new Chart(ctx, {
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
				text: 'Gráfico Umidade '
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