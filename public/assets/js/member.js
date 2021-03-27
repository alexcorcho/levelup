var startDateValidators = {
			            row: '.plan-start-date',
			            validators: {
			                notEmpty: {
			                    message: 'La fecha de inicio es obligatoria'
			                }
			            }
			        };

	$('#membersform').bootstrapValidator({
		fields: {
			member_code: {
				validators: {
					notEmpty: {
						message: 'El código de miembro es obligatorio y no puede estar vacío'
					}
				}
			},
			name: {
				validators: {
					notEmpty: {
						message: 'El nombre es obligatorio y no puede estar vacío'
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
						message: 'La dirección es obligatoria y no puede estar vacía'
					},
					stringLength: {
                        max: 200,
                        message: 'Debe tener menos de 200 caracteres'
                    }
				}
			},
			email: {
				validators: {
					notEmpty: {
						message: 'La dirección de correo electrónico es obligatoria y no puede estar vacía'
					},
					emailAddress: {
						message: 'La entrada no es una dirección de correo electrónico válida'
					},
					stringLength: {
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres.'
                    }
				}
			},
			DOB: {
				validators: {
					notEmpty: {
						message: 'La fecha de nacimiento es obligatoria'
					},
					date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha debe estar en formato AAAA-MM-DD'
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
			health_issues: {
				validators: {
					notEmpty: {
						message: 'Este campo es obligatorio y no puede estar vacío'
					}
				}
			},
			proof_name: {
				validators: {
					notEmpty: {
						message: 'El nombre de la prueba es obligatorio y no puede estar vacío'
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
						message: 'El género es obligatorio y no puede estar vacío'
					}
				}
			},
			plan_id: {
				validators: {
					notEmpty: {
						message: 'La identificación del plan es obligatoria y no puede estar vacía'
					}
				}
			},
			pin_code: {
				validators: {
					notEmpty: {
						message: 'El Documento es obligatorio y no puede estar vacío'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'El Documento es obligatorio y no puede estar vacío'
					}
				}
			},
			occupation: {
				validators: {
					notEmpty: {
						message: 'La ocupación es obligatoria y no puede estar vacía.'
					},
					stringLength: {
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres.'
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
			invoice_number: {
				validators: {
					notEmpty: {
						message: 'El número de factura es obligatorio y no puede estar vacío'
					}
				}
			},
			admission_amount: {
				validators: {
					notEmpty: {
						message: 'El monto de la admisión es obligatorio y no puede estar vacío'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'La entrada no es una cantidad válida'
					}
				}
			},
			subscription_amount: {
				validators: {
					notEmpty: {
						message: 'El monto de la suscripción es obligatorio y no puede estar vacío'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'La entrada no es una cantidad válida'
					}
				}
			},
			taxes_amount: {
				validators: {
					notEmpty: {
						message: 'El monto de los impuestos es obligatorio y no puede estar vacío'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'La entrada no es una cantidad válida'
					}
				}
			},
			payment_amount: {
				validators: {
					notEmpty: {
						message: 'La cantidad es obligatoria y no puede estar vacía.'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'La entrada no es una cantidad válida'
					}
				}
			},
			invoice_id: {
				  validators: {
					  notEmpty: {
						message: 'El número de factura es obligatorio y no puede estar vacío'
					}
				}
			},
			date: {
				  validators: {
					  notEmpty: {
						message: 'La fecha de verificación es obligatoria y no puede estar vacía'
					}
				}
			},
			number: {
				  validators: {
					  notEmpty: {
						message: 'El número de cheque es obligatorio y no puede estar vacío.'
					}
				}
			},
			contact: {
				validators: {
					notEmpty: {
						message: 'El contacto es obligatorio y no puede estar vacío.'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'La entrada no es un número válido.'
					},
					stringLength: {
                        max: 10,
                        message: 'Debe tener menos de 10 caracteres.'
                    }
				}
			},
			emergency_contact: {
				validators: {
					notEmpty: {
						message: 'El contacto es obligatorio y no puede estar vacío.'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: 'La entrada no es un número válido.'
					},
					stringLength: {
                        max: 10,
                        message: 'Debe tener menos de 10 caracteres.'
                    }
				}
			},
			'plan[0].start_date' : startDateValidators								          
		}
	});
	

