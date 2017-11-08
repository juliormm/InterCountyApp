<div class="row">
	<div class="col-sm-6">
		<h3 class="">{{ $campaignObj->name }}</h3>
	</div>
	<div class="col-sm-6 well">
		
			<h4 class="text-center">Status</h4>
			<div class="row ">
				<div class="col-sm-6 text-center">
					Locked
					<button id="locked-campaign" type="button" class="btn btn-lg btn-toggle {{ ($campaignObj->locked === 1) ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ ($campaignObj->locked === 1) ? 'true' : 'false' }}" autocomplete="off">
						<div class="handle"></div>
					</button>
				</div>

				
				<div class="col-sm-6 text-center">
					Live
					<button id="live-campaign" type="button" class="btn btn-lg btn-toggle {{ ($campaignObj->live === 1) ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ ($campaignObj->live === 1) ? 'true' : 'false' }}" autocomplete="off">
						<div class="handle"></div>
					</button>
				</div>
			</div>
	</div>
</div>

@include('campaign.campaign-sub-nav')

@if (session('status'))
	<div class="alert alert-success">
	    {{ session('status') }}
	</div>
@endif