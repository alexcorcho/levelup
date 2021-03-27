$(document).ready(function() {
				$('#expensecategoriesform').bootstrapValidator({
					fields: {
						name: {
							validators: {
								notEmpty: {
									message: 'El nombre de la categoría es obligatorio y no puede estar vacío'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						}
					}
				});
			});