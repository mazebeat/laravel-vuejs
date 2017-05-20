@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Send Message
					</div>

					<div class="panel-body">
						<form action="{{ route('messages.store') }}" method="POST">
							{{ csrf_field() }}

							<div class="form-group">
								<select name="to_user" id="to_user" class="form-control">
									<option value="">Select user to...</option>
									@foreach($users as $user)
										<option value="{{ $user->id }}">{{ $user->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<textarea name="message" id="message" class="form-control" placeholder="Write your message here!..."></textarea>
							</div>

							<div class="form-group">
								<button class="btn btn-primary btn-block">Send</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
