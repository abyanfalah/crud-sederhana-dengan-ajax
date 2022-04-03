let _user = {}

function loadUser(id = null) {
	$.ajax({
		url: 'api/read.php' + (id ? "?id="+id : ""),
		type: 'get',
		async: false,
		success: function(res){
			console.log(res)
			// let counter = 1
			// for(let n of Object.keys(res)){
			// 	let row = document.createElement('tr')
			// 	let col = document.createElement('td')
			// 	row.append(col)
			// }
		}
	});
}


function clearForms(){
	$("input").val('');
}

$(document).ready(function(){
	loadUser()
	// refreshTable()

	$("#modalAdd").modal('show')

	$(document).on('click','#btnSaveAdd', function(){
		$.ajax({
			url: 'api/create.php',
			type: 'post',
			data: $("#formAdd").serializeArray(),
			success: function(res){
				console.log(res)
				loadUser();
				$("#modalAdd").modal('hide')
				clearForms();
			}
		})
	})

})