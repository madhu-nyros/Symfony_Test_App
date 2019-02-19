// stories.addEventListener('click' ,e => {
// 	if(e.target.className === 'btn btn-danger') {
// 		if(confirm('Are you sure ? ')) {
// 			const id= e.target.getAttribute('data-id');
			
// 			fetch(`/story/delete/${id}`,{
// 				method:'DELETE'
// 			}).then(res => 
// 				window.location.reload());
				
// 		}
// 	}
// })