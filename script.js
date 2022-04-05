let _user = {}
let id

function loadUser(id = null) {
	let data
	let a
	$.ajax({
		url: 'api/read.php' + (id ? "?id="+id : ""),
		type: 'get',
		async: false,
		success: function(res){
			data = res
			for(let n of Object.keys(res)){
				_user[res[n].id] = {}
				for(let fields of Object.keys(res[n])){
					// if (fields == 'id') { continue }
					_user[res[n].id][fields] = res[n][fields]
				}
			}
		}
	});
	// console.log(_user)
	return data
}

function refresh(res = loadUser()) {
	$("#userTable").html('')
	let counter = 1
	let row, col
	for(let n of Object.keys(res)){
		row = document.createElement('tr')
		col = document.createElement('td')
		col.textContent = counter++
		row.append(col)
		for(let fields of Object.keys(res[n])){
			col = document.createElement('td')
			col.textContent = res[n][fields]
			row.append(col)

		}

		// option buttons
		for(let i = 0; i<2; i++){
			col = document.createElement('td')
			btn = document.createElement('button')
			btn.classList.add('btn', 'btn-sm', 'btn-' + (i < 1 ? 'warning' : 'danger'))
			btn.classList.add('btn' + (i < 1 ? 'Edit' : 'Delete'))
			btn.setAttribute('data-id', res[n].id)
			// btn.setAttribute('data-toggle', 'modal')
			// btn.setAttribute('data-target', (i < 1 ? '#modalEdit' : '#modalDelete'))
			btn.setAttribute('data-backdrop', 'static')
			btn.textContent = (i < 1 ? 'Edit' : 'Delete')
			
			col.append(btn)
			row.append(col)
		}
		//================== 
		clearForms()
		$("#userTable").append(row)
	}
}


function clearForms(){
	$("input").val('');
}

$(document).ready(function(){
	// loadUser()
	refresh()


	// $("#modalEdit").modal('show')


	// ADD SECTION
		$(document).on('click','#btnSaveAdd', function(){
			// $.ajax({
			// 	url: 'api/create.php',
			// 	type: 'post',
			// 	data: $("#formAdd").serializeArray(),
			// 	success: function(res){
			// 		if (res.status) {
			// 			refresh()
			// 			$("#modalAdd").modal('hide')
			// 		}
			// 		console.log(res)
			// 	}
			// })

			$.post('api/create.php', $("#formAdd").serializeArray(), function(res){
				if (res.status) {
					refresh()
					$("#modalAdd").modal('hide')
				}
				console.log(res)
			})

	})
	// END OF ADD SECTION

	// EDIT SECTION
		$(document).on('click', '.btnEdit', function(){
			id = $(this).attr('data-id')
			// =====
			$(".userNameSpan").text(_user[id].name)
			$("input[name=id]").val(id)
			$("input[name=name]").val(_user[id].name)
			$("input[name=dob]").val(_user[id].dob)
			$("#modalEdit").modal('show')

		})


		$(document).on('click', "#btnSaveEdit", function(){
			// $.ajax({
			// 	url: "api/update.php",
			// 	type: 'post',
			// 	data: $("#formEdit").serializeArray(),
			// 	success: function(res){
			// 		if (res.status) {
			// 			refresh();
			// 			$("#modalEdit").modal('hide')
			// 			clearForms()
			// 		}
			// 		console.log(res)
			// 	}
			// })

			$.post('api/update.php', $("#formEdit").serializeArray(), function(res){
				if (res.status) {
					refresh()
					$("#modalEdit").modal('hide')
					clearForms()
				}
				console.log(res)
			})
		})
	// END OF EDIT SECTION


	// DELETE SECTION
		$(document).on('click', '.btnDelete', function(){
			id = $(this).attr('data-id')
			$(".userNameSpan").text(_user[id].name)
			$("#modalDelete").modal('show')
		})

		$(document).on('click', '#btnProceedDelete', function(){
			// $.ajax({
			// 	url: "api/delete.php",
			// 	type: "post",
			// 	data: {id: id},
			// 	success: function(res){
			// 		if (res.status) {
			// 			refresh()
			// 			$("#modalDelete").modal('hide')
			// 		}
			// 		console.log(res)
			// 	}
			// })

			$.post('api/delete.php', {id: id}, function(res){
				if (res.status) {
					refresh()
					$("#modalDelete").modal('hide')
				}
				console.log(res)
			})
		})
	// END OF DELETE SECTION

	$(document).on('click', '#btnTruncate', function(){
		$.ajax({
			url: 'api/truncate.php',
			success: function(res){
				console.log(res)
			}
		})
	})

})

