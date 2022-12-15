<div class="container">
	<h3 class="text-center"> Rheological </h3>
	<br>

	<div class="row">
		<div class="col-md-12">
			<form method="GET" action="">
				<div class="row">
					<div class="col-md-6">
						<div class="inputArea">
							<table class="table">
								<tr>
									<th class="text-center">N</th>
									<th class="text-center">Ɵ</th>
								</tr>
								@for($i=0; $i < count((array) $nParam); $i++) <tr>
									<th>{{ $nParam[$i] }}</th>
									<td>
										<input type="number" step="any" name="dial_reading_fann_data[]" class="form-control-custom" required value="{{ @$dialReading[$i] }}" />
									</td>
									</tr>
									@endfor
							</table>
							<button type="submit" class="btn btn-primary" id="calculate"> <i class="fa fa-calculator"></i> Calculate </button>
						</div>
					</div>
					<div class="col-md-6">
						<strong>Pilih Model</strong>
						<select class="form-control" name="model" required>
							<option value="semua">Semua Model</option>
							@foreach(\App\Helpers\Dropdown::listRheologicalModel() as $key => $value)
							<option @if ($model==$key) selected @endif value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>

						<br>

						<div class="grafikArea">
							<canvas id="myChart"></canvas>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<br>

	<div class="row">
		@if ($model == 'fann_data' || $model == 'semua')
		<div class="col-md-6">
			<h4>Fann Data</h4>

			<table class="table table-bordered table-stripped">
				<tr style="background-color: rgb(255, 0, 0); color: white;">
					<th class="text-center">N</th>
					<th class="text-center">Ɵ</th>
					<th class="text-center">Ƴ (1/s)</th>
					<th class="text-center">Ʈ (lb/ft^2)</th>
					<th class="text-center">Ʈ (Psi)</th>
				</tr>
				@for($i=0; $i < count((array) $n); $i++) <tr>
					<th>{{ $n[$i] }}</th>
					<td>{{ (double) @$dialReading[$i] }}</td>
					<td>{{ $n[$i] * 1.70333 }}</td>
					<td>{{ 0.01065 * (double) @$dialReading[$i] }}</td>
					<td>{{ 0.01065 * (double) @$dialReading[$i] * 0.0069444444443639 }}</td>
					</tr>
					@endfor
			</table>
		</div>
		@endif

		@if ($model == 'newtonian_model' || $model == 'semua')
		<div class="col-md-6">
			<h4>Newtonian Model</h4>

			<table class="table table-bordered table-stripped">
				<tr style="background-color: rgb(238, 130, 238);">
					<th class="text-center">N</th>
					<th class="text-center">Ɵ</th>
					<th class="text-center">Ƴ (1/s)</th>
					<th class="text-center">𝜇 (Pa-s)</th>
					<th class="text-center">Ʈ (Pa)</th>
					<th class="text-center">Ʈ (Psi)</th>
				</tr>
				@for($i=0; $i < count((array) $n); $i++) @php $cColumn=$n[$i] * 1.70333; $dColumn=((300 / $n[0]) * (double) @$dialReading[0]) * 0.001; $eColumn=$dColumn * $cColumn; $fColumn=$eColumn * 0.000145038; @endphp <tr>
					<th>{{ $n[$i] }}</th>
					<td>{{ (double) @$dialReading[$i] }}</td>
					<td>{{ $cColumn }}</td>
					<td>{{ $dColumn }}</td>
					<td>{{ $eColumn }}</td>
					<td>{{ $fColumn }}</td>
					</tr>
					@endfor
			</table>
		</div>
		@endif

		@if ($model == 'power_law' || $model == 'semua')
		<div class="col-md-12">
			<h4>Power - Law</h4>

			<table class="table table-bordered table-stripped">
				<tr style="background-color: rgb(60, 179, 113); color: white;">
					<th class="text-center">N</th>
					<th class="text-center">Ɵ</th>
					<th class="text-center">Ƴ (1/s)</th>
					<th class="text-center">n</th>
					<th class="text-center">K (Pa-s)</th>
					<th class="text-center">Ʈ (Pa)</th>
					<th class="text-center">Ʈ (Psi)</th>
				</tr>
				@for($i=0; $i < count((array) $n); $i++) @php $cColumn=$n[$i] * 1.70333; $dColumn=log10(((double) @$dialReading[0] * 1.70333) / ((double) @$dialReading[1] * 1.70333)) * 3.32192809; $eColumn=((510 * (double) @$dialReading[0]) / (pow((1.703 * $n[0]), $dColumn))) * 0.001; $fColumn=$eColumn * (pow($cColumn, $dColumn)); $gColumn=$fColumn * 0.000145038; @endphp <tr>
					<th>{{ $n[$i] }}</th>
					<td>{{ (double) @$dialReading[$i] }}</td>
					<td>{{ $cColumn }}</td>
					<td>{{ $dColumn }}</td>
					<td>{{ $eColumn }}</td>
					<td>{{ $fColumn }}</td>
					<td>{{ $gColumn }}</td>
					</tr>
					@endfor
			</table>
		</div>
		@endif

		@if ($model == 'bingham_plastic' || $model == 'semua')
		<div class="col-md-12">
			<h4>Bingham - Plastic</h4>

			<table class="table table-bordered table-stripped">
				<tr style="background-color: rgb(0, 0, 255); color: white;">
					<th class="text-center">N</th>
					<th class="text-center">Ɵ</th>
					<th class="text-center">Ƴ (1/s)</th>
					<th class="text-center">𝜇p (Pa-s)</th>
					<th class="text-center">Ʈy (Pa)</th>
					<th class="text-center">Ʈ (Pa)</th>
					<th class="text-center">Ʈ (Psi)</th>
				</tr>
				@if (count((array) $n) > 0)
				@php
				$dColumnParam = ((300 / ($n[0] - $n[1])) * ((double) @$dialReading[0] - (double) @$dialReading[1]) * 0.001);
				$dColumnParam2 = ((300 / ($n[0] - $n[1])) * ((double) @$dialReading[0] - (double) @$dialReading[1]));
				$eColumn = ((double) @$dialReading[1] - $dColumnParam2) * 0.47880258888889;
				@endphp
				@endif
				@for($i=0; $i < count((array) $n); $i++) @php $cColumn=$n[$i] * 1.70333; $fColumn=($eColumn + ($dColumnParam * $cColumn)); $gColumn=$fColumn * 0.000145038; @endphp <tr>
					<th>{{ $n[$i] }}</th>
					<td>{{ (double) @$dialReading[$i] }}</td>
					<td>{{ $cColumn }}</td>
					<td>
						@if ($i == 0)
						{{ $dColumnParam }}
						@endif

						@if ($i == 1)
						{{ $dColumnParam2 }}
						@endif
					</td>
					<td>
						@if ($i == 0)
						{{ $eColumn }}
						@endif
					</td>
					<td>{{ $fColumn }}</td>
					<td>{{ $gColumn }}</td>
					</tr>
					@endfor
			</table>
		</div>
		@endif

		@if ($model == 'herschel_buckley' || $model == 'semua')
		<div class="col-md-12">
			<h4>Herschel - Buckley</h4>

			<table class="table table-bordered table-stripped">
				<tr style="background-color: rgb(255, 165, 0);">
					<th class="text-center">N</th>
					<th class="text-center">Ɵ</th>
					<th class="text-center">Ƴ (1/s)</th>
					<th class="text-center">Ʈy (Pa)</th>
					<th class="text-center">n</th>
					<th class="text-center">K (Pa-s)</th>
					<th class="text-center">Ʈ (Pa)</th>
					<th class="text-center">Ʈ (Psi)</th>
				</tr>

				@if (count((array) $n) > 0)
				@php
				$dColumnParam2 = (2 * (double) @$dialReading[5]) - (double) @$dialReading[4];
				$dColumnParam = $dColumnParam2 * 0.47880258888889;
				$eColumn = 3.32192809 * (log10(((double) @$dialReading[0] - $dColumnParam2) / ((double) @$dialReading[1] - $dColumnParam2)));
				$fColumn = 500 * (((double) @$dialReading[1] - $dColumnParam2) / (pow(511, $eColumn))) * 0.001;
				@endphp
				@endif

				@for($i=0; $i < count((array) $n); $i++) @php $cColumn=$n[$i] * 1.70333; $gColumn=($dColumnParam + ($fColumn * pow($cColumn, $eColumn))); $hColumn=$gColumn * 0.000145038; @endphp <tr>
					<th>{{ $n[$i] }}</th>
					<td>{{ (double) @$dialReading[$i] }}</td>
					<td>{{ $cColumn }}</td>
					<td>
						@if ($i == 0)
						{{ $dColumnParam }}
						@endif

						@if ($i == 1)
						{{ $dColumnParam2 }}
						@endif
					</td>
					<td>
						@if ($i == 0)
						{{ $eColumn }}
						@endif
					</td>
					<td>
						@if ($i == 0)
						{{ $fColumn }}
						@endif
					</td>
					<td>{{ $gColumn }}</td>
					<td>{{ $hColumn }}</td>
					</tr>
					@endfor
			</table>
		</div>
		@endif

	</div>
</div>