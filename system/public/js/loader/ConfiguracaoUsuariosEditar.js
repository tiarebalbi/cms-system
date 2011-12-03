$(document).ready(function(){
	$('.dataNascimento').mask("99/99/9999");
	
	jQuery('.pass_check').pstrength({
		'minChar': 6,
		'minCharText': 'Sua senha deve ter ao menos %d caracteres',
		'colors': ["#f00", "#c06", "#f60", "#3c0", "#3f0"],
		'scores': [20, 30, 43, 60],
		'verdicts':	['Fraca', 'Normal', 'Bom', 'Forte', 'Muito Forte'],
		'raisePower': 1.4
	});
});