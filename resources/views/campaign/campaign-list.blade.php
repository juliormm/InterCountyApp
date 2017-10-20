@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
 		<table class="table">
		 <tr>
		 	<th>
		 		Campaign Name
		 	</th>
		 	<th>
		 		Active
		 	</th>

		 	<th>
		 		Edit
		 	</th>

		 </tr>
		 @foreach ($campaignList as $key => $item)
			 <tr>
			 	<td>
			 		{{ $item }}
			 	</td>
			 	<td>
			 		no
			 	</td>

			 	<td>
			 		<a href="./campaigns/{{ $key }}/edit" class="btn btn-default">Edit</a>
			 	</td>
			 </tr>
		 @endforeach
		</table>

    </div>
</div>



@endsection



