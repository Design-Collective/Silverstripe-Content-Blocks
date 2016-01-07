<div class="row block">
	<% if $Header != "None" %>
		<div class="small-12 columns">
			<{$Header}>$Name</{$Header}>
	</div>
	<% end_if %>

	<% loop $OrderedBlocks %>

		<div class="small-12 large-{$ColumnClass($TotalItems)} columns block-nested">
			$Me
		</div>

	<% end_loop %>

</div>

