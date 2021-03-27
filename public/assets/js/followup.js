$(document).ready(function() {
				$('#followupform').bootstrapValidator({
					fields: {
						outcome: {
							validators: {
								notEmpty: {
									message: 'El resultado es obligatorio y no puede estar vacío.'
								}
							}
						}
					}
				})
			});