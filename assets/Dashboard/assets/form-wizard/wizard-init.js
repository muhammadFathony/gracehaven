
var form = $("#form_v");

	form.validate({
		errorPlacement: function errorPlacement(error, element) {
			element.after(error);
		}
	});
	form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex) {
                var title = $("#title").val();
				var content = $("#content").val();
				var location = $("#location").val();
				
				var data = [ title, content, location
				]
				var html = '';
					html += '<li>'+ title + '</li>' +
							'<li>'+ content + '</li>' +
							'<li>'+ location + '</li>' ;					
				
				document.getElementById("step3").innerHTML = html;
				console.log(data);

				form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
				
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
				 var form = document.forms.namedItem("form_v");
				
				$.ajax({
					type : "POST",
					//ini jadi aneh sblumnya "new_Blog"
					url  : "Blog/new_Blog",
					dataType : "JSON",
					data: new FormData(form),
					processData:false,
					contentType:false,
					cache:false,
					async:true,
				
					success : function(data){
						csrf_test_name = data.csrf_test_name;

						alert("sukses");
					}

				})
			
            }
});


