let _user = {}

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
					if (fields == 'id') { continue }
					_user[res[n].id][fields] = res[n][fields]
				}
			}
		}
	});
	// console.log(_user)
	return data
}

function refresh(res = loadUser()) {
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
			btn.setAttribute('data-id', res[n].id)
			btn.setAttribute('data-toggle', 'modal')
			btn.setAttribute('data-target', (i < 1 ? '#modalEdit' : '#modalDelete'))
			btn.setAttribute('data-backdrop', 'static')
			btn.textContent = (i < 1 ? 'Edit' : 'Delete')
			
			col.append(btn)
			row.append(col)
		}
		$("#userTable").innerHTML = ''
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

	$(document).on('click','#btnSaveAdd', function(){
		$.ajax({
			url: 'api/create.php',
			type: 'post',
			data: $("#formAdd").serializeArray(),
			success: function(res){
				console.log(res)
				refresh();
				$("#modalAdd").modal('hide')
			}
		})

	})

})

