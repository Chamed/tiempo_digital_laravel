<!DOCTYPE html>
<html lang="pt-BR">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="module" src="{{ asset('js/auth.js')}}" type="module"></script>
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">

		<script src="https://code.jquery.com/jquery-3.6.3.js"
			integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
			crossorigin="anonymous"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
		<title>Entrar</title>
	</head>

	<body class="background">
		<div id="toast" class="toast bg-success text-white top-0 end-0 m-3" role="alert" aria-live="assertive"
			aria-atomic="true" data-bs-dismiss="toast">
			<div id="toastMessage" class="toast-body">
			</div>
		</div>
		<div class="main-content d-flex justify-content-center align-items-center">
			<div class="col-3 flex-column justify-content-center">
				<div class="form-container flex-column justify-content-center">
					<div class="d-flex justify-content-center">
						<img class="img-fluid" style="padding-bottom: 50px;" src="{{ asset('logo_tiempo.png') }}"
							alt="Logo">
					</div>
					<form id="form" method="POST" action="{{route('auth')}}" class="needs-validation" novalidate>
                        @csrf
						<div class="mb-3">
							<label for="email" class="form-label">Email: </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="height: 100%;">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
											<path
												d="M1.75 2h12.5c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0 1 14.25 14H1.75A1.75 1.75 0 0 1 0 12.25v-8.5C0 2.784.784 2 1.75 2ZM1.5 12.251c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25V5.809L8.38 9.397a.75.75 0 0 1-.76 0L1.5 5.809v6.442Zm13-8.181v-.32a.25.25 0 0 0-.25-.25H1.75a.25.25 0 0 0-.25.25v.32L8 7.88Z">
											</path>
										</svg>
									</div>
								</div>
								<input id="email" name="email" type="email" class="form-control" required>
								<div id="emailErrorMessage" class="invalid-feedback"></div>
							</div>
						</div>
						<div id="nameContainer" class="mb-3">
							<label for="name" class="form-label">Nome: </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="height: 100%;">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
											<path
												d="M10.561 8.073a6.005 6.005 0 0 1 3.432 5.142.75.75 0 1 1-1.498.07 4.5 4.5 0 0 0-8.99 0 .75.75 0 0 1-1.498-.07 6.004 6.004 0 0 1 3.431-5.142 3.999 3.999 0 1 1 5.123 0ZM10.5 5a2.5 2.5 0 1 0-5 0 2.5 2.5 0 0 0 5 0Z">
											</path>
										</svg>
									</div>
								</div>
								<input id="name" name="name" type="text" class="form-control">
								<div id="nameErrorMessage" class="invalid-feedback"></div>
							</div>
						</div>
						<div id="lastNameContainer" class="mb-3">
							<label for="last_name" class="form-label">Sobrenome: </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="height: 100%;">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
											<path
												d="M10.561 8.073a6.005 6.005 0 0 1 3.432 5.142.75.75 0 1 1-1.498.07 4.5 4.5 0 0 0-8.99 0 .75.75 0 0 1-1.498-.07 6.004 6.004 0 0 1 3.431-5.142 3.999 3.999 0 1 1 5.123 0ZM10.5 5a2.5 2.5 0 1 0-5 0 2.5 2.5 0 0 0 5 0Z">
											</path>
										</svg>
									</div>
								</div>
								<input id="lastname" name="lastname" type="last_name" class="form-control">
								<div id="lastnameErrorMessage" class="invalid-feedback"></div>
							</div>
						</div>
						<div class="mb-3">
							<label for="pass" class="form-label">Senha: </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="height: 100%;">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
											<path
												d="M10.5 0a5.499 5.499 0 1 1-1.288 10.848l-.932.932a.749.749 0 0 1-.53.22H7v.75a.749.749 0 0 1-.22.53l-.5.5a.749.749 0 0 1-.53.22H5v.75a.749.749 0 0 1-.22.53l-.5.5a.749.749 0 0 1-.53.22h-2A1.75 1.75 0 0 1 0 14.25v-2c0-.199.079-.389.22-.53l4.932-4.932A5.5 5.5 0 0 1 10.5 0Zm-4 5.5c-.001.431.069.86.205 1.269a.75.75 0 0 1-.181.768L1.5 12.56v1.69c0 .138.112.25.25.25h1.69l.06-.06v-1.19a.75.75 0 0 1 .75-.75h1.19l.06-.06v-1.19a.75.75 0 0 1 .75-.75h1.19l1.023-1.025a.75.75 0 0 1 .768-.18A4 4 0 1 0 6.5 5.5ZM11 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z">
											</path>
										</svg>
									</div>
								</div>
								<input id="pass" name="pass" type="password" class="form-control">
								<div id="passErrorMessage" class="invalid-feedback"></div>
							</div>
						</div>
						<div id="confirmPassContainer" class="mb-3">
							<label for="confirmPass" class="form-label">Confirmar senha: </label>
							<div class="invalid-feedback">As senhas não combinam.</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="height: 100%;">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
											<path
												d="M10.5 0a5.499 5.499 0 1 1-1.288 10.848l-.932.932a.749.749 0 0 1-.53.22H7v.75a.749.749 0 0 1-.22.53l-.5.5a.749.749 0 0 1-.53.22H5v.75a.749.749 0 0 1-.22.53l-.5.5a.749.749 0 0 1-.53.22h-2A1.75 1.75 0 0 1 0 14.25v-2c0-.199.079-.389.22-.53l4.932-4.932A5.5 5.5 0 0 1 10.5 0Zm-4 5.5c-.001.431.069.86.205 1.269a.75.75 0 0 1-.181.768L1.5 12.56v1.69c0 .138.112.25.25.25h1.69l.06-.06v-1.19a.75.75 0 0 1 .75-.75h1.19l.06-.06v-1.19a.75.75 0 0 1 .75-.75h1.19l1.023-1.025a.75.75 0 0 1 .768-.18A4 4 0 1 0 6.5 5.5ZM11 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z">
											</path>
										</svg>
									</div>
								</div>
								<input id="confirmPass" name="confirmPass" type="password" class="form-control">
								<div id="confirmPassErrorMessage" class="invalid-feedback"></div>
							</div>
						</div>
						<div class="d-grid gap-2 mb-3">
							<button id="toggleStateButton" type="button" class="btn btn-secondary">
								Não tenho uma conta
							</button>
						</div>
						<div class="d-grid gap-2">
							<button id="submitButton" type="submit" class="btn btn-primary">Entrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>
