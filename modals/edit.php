<div class="modal fade" id="modalEdit" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body p-5">
				<h3>Edit <span class="userNameSpan"></span>'s information</h3>
				<form method="post" id="formEdit">
					<input type="hidden" name="id">

					<div class="form-group">
						<label>Name</label>
						<input class="form-control" type="text" name="name">
					</div>

					<div class="form-group">
						<label>DOB</label>
						<input class="form-control" type="date" name="dob">
					</div>
				</form>

				<button class="btn btn-primary" id="btnSaveEdit">Save</button>
				<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>