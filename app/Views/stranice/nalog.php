<!-- Mina Lesic-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
	
	<body >

		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="media">
						
						<div class="media-body ">
							<h3 class="mt-0 " style="padding-top:10px;">Moj nalog</h3>
							
						</div>
					</div>
					
				</div>
			</div>
                        
			<div class="row">
				<div  class="col-sm-12">
					
					<table class="table table">
						<tbody>
							<tr>
								<td><strong>Ime</strong></td>
								<td><?php echo $korisnik->Ime;?></td>
								<td></td>
							</tr>
							<tr>
								<td><strong>Prezime</strong></td>
								<td><?php echo $korisnik->Prezime;?></td>
								<td></td>
							</tr>
						
							<tr>
								<td><strong>Korisničko ime</strong></td>
								<td><?php echo $korisnik->Korisnicko_ime;?></td>
								<td></td>
							</tr>
							<tr>
								<td><strong>Lozinka</strong></td>
								<td><?php echo $korisnik->Password;?></td>
								<td><a href="novaLozinka.html" class="btn btn-outline-dark top-btn">Promeni lozinku</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="card border-info" style="width: 100%;">
					  <div class="card-header">
						Poseceni restorani
					  </div>
					  <ul class="list-group list-group-flush">
						<li class="list-group-item">Franš</li>
						<li class="list-group-item">Madera</li>
						<li class="list-group-item">Vapiano</li>
					  </ul>
					</div>

				</div>
				<div class="col-sm-6">
					<div class="card border-info"  style=" width: 100%;">
					  <div class="card-header">
						Ocenjeni restorani
					  </div>
					  <ul class="list-group list-group-flush">
						<li class="list-group-item">Franš</li>
						<li class="list-group-item">Madera</li>
						<li class="list-group-item">Vapiano</li>
					  </ul>
					</div>
						
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-6">
					<div class="card border-info" style="width: 100%; ">
					  <div class="card-header">
						Ostavljene recenzije
					  </div>
					  <ul class="list-group list-group-flush">
						<li class="list-group-item">Nema unetih recenzija</li>
						
					  </ul>
					</div>

				</div>
				<div class="col-sm-6">
					<div class="card border-info"  style=" width: 100%;">
					  <div class="card-header">
						Lista želja
					  </div>
					  <ul class="list-group list-group-flush">
						<li class="list-group-item">Moskva</li>
						<li class="list-group-item">Chez Nik</li>
						<li class="list-group-item">Tri šešira</li>
					  </ul>
					</div>
						
				</div>
			</div>
			<hr>
			
			
		
		</div> <!-- /container -->
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>

