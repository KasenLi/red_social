@extends('front.template.main')

@section('title', 'Perfil de ' . $user->name . ' | Red Social')

@section('content')
	<div class="container">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>Nombre</td>
						<td>{{$user->name}}</td>
					</tr>
					<tr>
						<td>Correo electrónico</td>
						<td>{{$user->email}}</td>
					</tr>
					<tr>
						<td>Nombre de usuario</td>
						<td>{{$user->username}}</td>
					</tr>
					<tr>
						<td>Fecha de nacimiento</td>
						<td>-</td>
					</tr>
					<tr>
						<td>Género</td>
						<td>-</td>
					</tr>
				</tbody>
			</table>
	</div>
@endsection