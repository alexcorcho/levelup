$(document).ready(function() {
				$('#enquiriesform').bootstrapValidator({
					fields: {
						name: {
							validators: {
								notEmpty: {
									message: 'El nombre es obligatorio y no puede estar vacío.'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						address: {
							validators: {
								notEmpty: {
									message: 'La dirección es obligatoria y no puede estar vacía.'
								},
								stringLength: {
			                        max: 200,
			                        message: 'Debe tener menos de 200 caracteres.'
			                    }
							}
						},
						email: {
							validators: {
								notEmpty: {
									message: 'La dirección de correo electrónico es obligatoria y no puede estar vacía.'
								},
								emailAddress: {
									message: 'La entrada no es una dirección de correo electrónico válida.'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						gender: {
							validators: {
								notEmpty: {
									message: 'El género es obligatorio y no puede estar vacío.'
								}
							}
						},
						pin_code: {
							validators: {
								notEmpty: {
									message: 'El Documento es obligatorio y no puede estar vacío'
								},
								regexp: {
									regexp: /^[0-9_\.]+$/,
									message: 'La entrada no es un Documento válido'
								}
							}
						},
						occupation: {
							validators: {
								notEmpty: {
									message: 'La ocupación es obligatoria y no puede estar vacía'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres'
			                    }
							}
						},
						aim: {
							validators: {
								notEmpty: {
									message: 'El objetivo es obligatorio y no puede estar vacío.'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						source: {
							validators: {
								notEmpty: {
									message: 'La fuente es obligatoria y no puede estar vacía.'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						date: {
							validators: {
								notEmpty: {
									message: 'La fecha es obligatoria y no puede estar vacía.'
								}
							}
						},
						due_date: {
							validators: {
								notEmpty: {
									message: 'La fecha de vencimiento es obligatoria y no puede estar vacía.'
								}
							}
						},
						followup_by: {
							validators: {
								notEmpty: {
									message: 'El campo es obligatorio y no puede estar vacío.'
								}
							}
						},
						status: {
							validators: {
								notEmpty: {
									message: 'El estado es obligatorio y no puede estar vacío'
								}
							}
						},
						outcome: {
							validators: {
								notEmpty: {
									message: 'El resultado es obligatorio y no puede estar vacío.'
								}
							}
						},
						interested_in: {
							validators: {
								notEmpty: {
									message: 'El campo es obligatorio y no puede estar vacío.'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						contact: {
							validators: {
								notEmpty: {
									message: 'El contacto es obligatorio y no puede estar vacío.'
								},
								regexp: {
									regexp: /^[0-9_\.]+$/,
									message: 'La entrada no es un número válido.'
								},
								stringLength: {
			                        max: 10,
			                        message: 'Debe tener menos de 11 caracteres'
			                    }
							}
						}
					}
				});
			});

