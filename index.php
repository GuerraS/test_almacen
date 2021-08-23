<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets\bootstrap-4\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\style.css">
	<link rel="stylesheet" href="assets\css\css-fontello\fontello.css">
    <link rel="stylesheet" href="assets\pluggins\select2\css\select2.min.css">
	<link rel="stylesheet" href="assets\pluggins\datatable\datatables.min.css">

    <link rel="stylesheet" href="assets\css\css-fontello\fontello.css">

</head>

<body>
	<nav class="nav py-3">
		<a class="nav-link zoom " href="#" data-toggle="modal" onclick="initModalExits()" data-target="#modalNewItem"><i class=" icon-box-arrow-in-down"></i></a>
		<a class="nav-link zoom " href="#" data-toggle="modal" data-target="#modalExits"><i class=" icon-box-arrow-up "></i></a>
	</nav>
    <div class="container-fluid">   
        <div class="row">
            <div class="col-sm-3 col-xs-6">
				<div class="row no-gutters">
					<div class="col-md-4 card-header text-center" style="background-color:#7acbee">
						<h5 id="in-counter">
							
						</h5>
					</div>
						<div class="col-md-8">
						<div class="card-body text-center">
							<h5 class="card-title">Ingresos</h5>
							
						</div>
					</div>
				</div>
            </div>
            <div class="col-sm-3 col-xs-6">
				<div class="row no-gutters">
					<div class="col-md-4 card-header text-center"  style="background-color:#a3c86d">
						<h5 id="out-counter">
							
						</h5>
					</div>
						<div class="col-md-8">
						<div class="card-body text-center">
                       
						<h5>Egresos</h5>
                      
                    </div>
					</div>
				</div>			
			</div>
            <div class="col-sm-3 col-xs-6">
				<div class="row no-gutters">
					<div class="col-md-4 card-header text-center"  style="background-color:#fdd761">
						<h5 id="categorie-counter">
							
						</h5>
					</div>
						<div class="col-md-8">
							<div class="card-body text-center">
						
								<h5>Categorias</h5>
                      
                    		</div>
					</div>
				</div>
				
			</div>
            <div class="col-sm-3 col-xs-6">
				<div class="row no-gutters">
					<div class="col-md-4 card-header text-center"style="background-color:#ff7857" #ff7857>
						<h5 id="total-counter">
							
						</h5>
					</div>
						<div class="col-md-8">
							<div class="card-body text-center">
						
								<h5>Total</h5>  
                      
                    		</div>
					</div>
				</div>
				
			</div>
        </div>
		<br>
		<div class="row" id="container-categories" >
			<div class="col-sm-12" style="padding:unset">
				<ul class="list-group-horizontal">
					<div class="card list-group-item" >
						<div class="card-header ">
						
						<h5 class="card-title">Calidad alta</h5>

						
						</div>
						<div class="card-body ">
						
							<h4 class="card-title"  id="counter-alta"></h4>
							
							<a href="#" class="btn btn-primary">Ver detalles</a>                
						</div>
					</div>
					<div class="card list-group-item" >
						<div class="card-header ">
						
						<h5 class="card-title">Calidad baja</h5>
						
						</div>
						<div class="card-body ">
						
							<h4 class="card-title" id="counter-baja"></h4>
							
							<a href="#" class="btn btn-primary">Ver detalles</a>                
						</div>
					</div>
					
					
				</ul>
			</div>		
		</div>
    </div>
    
	<div class="modal fade" id="modalNewItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content container"style="width:100%">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ingresos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<form class="form-horizontal hide" id="formNewItem" onsubmit="return false" action="">  
					<div class="modal-body"  >  
						<div class="form-group row">
							<label for="amount" class="col-sm-2 col-form-label">Cantidad</label>
							<div class="col-sm-10">
								<input type="number" step="1" min="1" value="1" class="form-control" name="amount" id="amount" required>
							</div>
						</div>                        
						<div class="form-group row">
							<label for="selectCalidad" class="col-sm-2 col-form-label">Calidad</label>
							<div class="col-sm-10">
								<select class="form-control" id="selectCalidad" name="selectCalidad"  style="width:100%;height:auto;" required>
									<option></option>   
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="selectModelo" class="col-sm-2 col-form-label">Modelo</label>
							<div class="col-sm-10">
								<select class="form-control" id="selectModelo" name="selectModelo"  style="width:100%;height:auto;" required>
									<option></option>   
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="selectMaterial" class="col-sm-2 col-form-label">Material</label>
							<div class="col-sm-10">
								<select class="form-control" id="selectMaterial" name="selectMaterial"  style="width:100%;height:auto;" required>
									<option></option>   
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="capacidad" class="col-sm-2 col-form-label">Capacidad</label>
							<div class="col-sm-10">
								<input type="number" step="1" min="1"  max="750" class="form-control" name="capacidad" id="capacidad" placeholder="Ingresa en mililitros" required>
							</div>
						</div>  
						<div class="form-group row">
							<label for="color" class="col-sm-2 col-form-label">Color</label>
							<div class="col-sm-10">
								<input type="color" value="#38809f" class="form-control" name="color" id="color" required>
							</div>
						</div>  
						
					</div>        
					<div class="modal-footer">
						<button type="button" class="btn cancel-submit" data-dismiss="modal">Cancelar</button>
						<button type="submit"  onclick="initFunction.insertItem()" class="btn btn-success" onclick="" >Aceptar</button>
					</div>          
				</form>
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalExits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content container" style="width:100%">
				<div class="modal-header">
					<h5 class="modal-title" id="">Egresos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<form class="form-horizontal hide" id="formExits" onsubmit="return false" action="">  
					<div class="modal-body"  > 

					
						<div class="form-group row">
						
							<div class="col-md-12">
								<select class="form-control" id="selectCalidadExits" name="selectCalidadExits"  style="width:40%;height:auto;" required>
									<option></option>   
								</select>
							</div>
						</div>						
					
						<div class="row">
							<div class="table-responsive">
								<table class="table" id="table-exits">
									<thead>
										<tr>

											<th scope="col">Color</th>
											<th scope="col">Capacidad</th>
											<th scope="col">Material</th>
											<th scope="col">Modelo</th>
											<th scope="col">Cantidad</th>
											<th scope="col">#</th>
										</tr>
									</thead>
									<!-- <tbody>
										<tr>							
											<td><div style="background-color:blue; border-radius:4px" class="label">&nbsp;</div></td>
											<td>255 ml</td>
											<td>Vinilo</td>
											<td>Vintage</td>
											<td>45</td>
											<td>
												<input type="number" step="1" min="1"  max="750" class="form-control" name="capacidad" id="capacidad" placeholder="total de items" required>

											</td>
										</tr>
										<tr>
											<td><div style="background-color:blue; border-radius:4px" class="label">&nbsp;</div></td>
											<td>255 ml</td>
											<td>Vinilo</td>
											<td>Vintage</td>
											<td>45</td>
											<td>
												<input type="number" step="1" min="1"  max="750" class="form-control" name="capacidad" id="capacidad" placeholder="total de items" required>

											</td>
										</tr>
										<tr>
											<td><div style="background-color:blue; border-radius:4px" class="label">&nbsp;</div></td>
											<td>255 ml</td>
											<td>Vinilo</td>
											<td>Vintage</td>
											<td>45</td>
											<td>
												<input type="number" step="1" min="1"  max="750" class="form-control" name="capacidad" id="capacidad" placeholder="total de items" required>

											</td>
										</tr>
									</tbody> -->
								</table>
							</div>
						</div>		
					</div>        
					<div class="modal-footer">
						<button type="button" class="btn cancel-submit" data-dismiss="modal">Cancelar</button>
						<button type="submit"  class="btn btn-success"  >Aceptar</button>
					</div>          
				</form>
				
			</div>
		</div>
	</div>

</div>
	<script src="assets\js\jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets\pluggins\select2\css\select2.min.css">
    <script src="assets\bootstrap-4\js\bootstrap.js"></script>
	<script src="assets\pluggins\select2\js\select2.min.js"></script>
	<script src="assets\pluggins\datatable\datatables.min.js"></script>

	<script type="text/javascript" src="assets\js\index.js"></script>


</body>



</html>